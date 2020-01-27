<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use Cake\I18n\Time;

/**
 * Authors Model
 *
 * @property \App\Model\Table\NewsTable|\Cake\ORM\Association\HasMany $News
 *
 * @method \App\Model\Entity\Author get($primaryKey, $options = [])
 * @method \App\Model\Entity\Author newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Author[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Author|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Author patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Author[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Author findOrCreate($search, callable $callback = null, $options = [])
 */
class AuthorsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('authors');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('News', [
            'foreignKey' => 'author_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->dateTime('downloaded')
            ->allowEmpty('downloaded');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->allowEmpty('name');

        return $validator;
    }


    /**
     * Find or create entity - by Author's name
     *
     * @author Piotr Zając
     * @since 2017-12-11
     *
     * @todo Add cache for existing records
     */
    public function getAuthorId($name) {
        
        $name = trim($name);

        $dbResult = $this->find()
            ->where(['name' => $name])
            ->first();

        if (!empty($dbResult)) {
            return ($dbResult->id);
        }

        $newAuthor = $this->newEntity();
        $this->patchEntity($newAuthor, [
            'name' => $name,
            'downloaded' => Time::now()
        ]);
        
        if (!$this->save($newAuthor)) {
            throw new Exception(__('Author could not be saved. Please, try again.'));
        }

        return $newAuthor->id;

    } // getAuthorId

}
