<?php
namespace App\Utility;

use Cake\Core\Configure;
use Cake\Cache\Cache;
use Cake\I18n\Time;
use Cake\Http\Client;

class F1wmWebsiteParser extends WebsiteParser {

    /**
     * Protocol and domain of website
     * Could be used for testing proposes
     * (without ending slash!)
     *
     * @var String
     */
    protected $websiteDomain = 'http://f1wm.pl';

	public function getNews($newsId) {

        // building URL of article
        // ex. url: http://f1wm.pl/php/news_id-42013.html
        $url = sprintf(
            '%s/php/news_id-%d.html',
            $this->websiteDomain,
            $newsId
        );

        $dom = $this->getDocumentObjectModel($url);

        // variables to be assigned to News model
        $record = [
            'id' => (int)$newsId,
            'title' => null,
            'created' => null,
            'author_id' => null,
            'excerpt' => null,
            'body' => null
        ];


        // finding article title
        $articleTitleElement = $dom->find('td.srodekstrony h2', 0);
        if (count($articleTitleElement) >= 1) {
            $record['title'] = $articleTitleElement->text;
        }


        // finding article excerpt (lead text)
        $articleTexts = $dom->find('td.srodekstrony td.tekst');

        if (count($articleTexts) >= 1) {
            $record['excerpt'] = $articleTexts[0]->text;
        }
        else {
            $record['excerpt'] = null;
        }


        // find article metadata (author, date, etc)
        $articleMetadata = $dom->find('td.srodekstrony td.tekst2p');

        // metadata found in article...
        if (count($articleMetadata) == 1) {
            $_metadata = explode(', ', $articleMetadata[0]->text);

            // getting ID of 'author' 
            if (!empty($_metadata[0])) {
                $record['author_id'] = $this->models['Authors']->getAuthorId(trim($_metadata[0]));
            }

            // parsing 'date'
            if (!empty($_metadata[1])) {
                $record['created'] = \App\Utility\TextParser::parsePolishDate($_metadata[1]);
            }

        } // if



        // getting article content...
        $articleBodyElement = $dom->find('#trescnewsa');
        if (count($articleBodyElement) == 1) {
            // html:
            $record['contents'] = $articleBodyElement[0]->innerHtml;
            // raw text:
            // $record['contents'] = $articleBodyElement[0]->text;
        }
        else {
            throw new \Exception(__('Unexpected HTML format: `#trescnewsa` not present'));
        }

        return $record;
    }
}

