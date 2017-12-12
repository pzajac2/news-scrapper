<?php
use Migrations\AbstractSeed;

/**
 * Authors seed.
 */
class AuthorsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'downloaded' => '2017-12-12 20:16:32',
                'name' => 'Jan Kowalski',
            ],
        ];

        $table = $this->table('authors');
        $table->insert($data)->save();
    }
}
