<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Core\Configure;
use Cake\Cache\Cache;
use Cake\I18n\Time;
use Cake\Http\Client;

use App\Model\Entity\Author;
use App\Model\Entity\News;

use Sunra\PhpSimple\HtmlDomParser;

use App\Utility\TextParser;

use App\Utility\F1wmWebsiteParser;


/**
 * News shell command.
 */
class NewsShell extends Shell {

    /**
     * @var \AppUtility\F1wmWebsiteParser
     */
    protected $f1Website;

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser() {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main() {
        $this->out($this->OptionParser->help());
    }

    /**
     * initialize() method
     */
    public function initialize() {
        parent::initialize();
        
        // loading required Models
        $this->loadModel('News');
        $this->loadModel('Authors');

        $this->f1Website = new F1wmWebsiteParser();
        $this->f1Website->bindModel('Authors', $this->Authors);

        // setting up variables (from config)
        // todo - loading from Configuration
        // if (Configure::read('app.f1wm_url') !== false) {
        //     $this->setWebsiteDomain(Configure::read('app.f1wm_url'));
        // }

    }


    /**
     * Downloads article with selected ID via http
     * 
     * @author Piotr Zając
     * @since 2017-12-11
     *
     * @param int $newsId ID of article
     * @return \App\Model\Entity\News News Entity (model)
     * @throws \Exception HTTP errors
     */
    protected function downloadArticleData($newsId) {

        $record = $this->f1Website->getNews($newsId);

        // checking if article already exists id DB
        try {
            $newsEntity = $this->News->get($newsId);
        }
        catch(\Cake\Datasource\Exception\RecordNotFoundException $e) {
            // not exists - creating new one:
            $newsEntity = $this->News->newEntity();
        }

        // filling model with new data ($record)
        $this->News->patchEntity($newsEntity, $record);

        // returning object
        return $newsEntity;

    } // downloadArticleData()


    /**
     * Downloads article with selected ID via HTTP
     *
     * Method to be executed from shell (visual output)
     * 
     * @author Piotr Zając
     * @since 2017-12-11
     */
    public function downloadArticleWithId($newsId) {
        
        $breakOnError = true;

        $this->out(__('Downloading news, id={0}', (int)$newsId));
        try {
            $newsEntity = $this->downloadArticleData($newsId);

            if ($this->News->save($newsEntity)) {
                $this->out(__('News with ID {0} succesfully saved!', $newsId));
            }
            else {
                $this->out(__('News with ID {0} couldn\'t be saved', $newsId));

                foreach($newsEntity->errors() as $_field => $_errorMsg) {
                    $this->out(sprintf(' * `%s` - %s', $_field, implode($_errorMsg)));
                }
            }
        }
        catch (\PDOException $e) {
            throw $e;
        }
        catch (\Exception $e) {
            $this->out('Exception:');
            $this->out($e);
        }

    } // downloadArticleWithId($newsId)


    /**
     * Downloads newest articles 
     *
     * Method to be executed from shell (visual output)
     * 
     * @author Piotr Zając
     * @since 2017-12-11
     */
    public function downloadNewArticles() {

    } // downloadNewArticles()



} // class NewsShell
