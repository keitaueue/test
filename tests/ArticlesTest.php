<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Article;

/**
 * 
 */
class ArticlesTest extends TestCase
{
    //use DatabaseMigrations;
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * @dataProvider___ additionProvider
     */
    public function testIndex()
    {

        // mockの登録
        $this->app->extend(ExtendClass::class, function ($instance) {
            $aaa = new Article();
            $aaa->title = 'aaaa';
            $aaa->body = 'aaaa';
            $instance->returning = $aaa;
            return $instance;
        });

        $this->app->bind(\App\Service\ArticleService::class, ExtendClass::class);
        
        
        $this
            ->visit('/')      // このパスに対して試験を行う
            ->see('一覧に戻る');
    }

    public function testCreateOK()
    {
        //emailを生成
        $faker = Faker\Factory::create('ja_JP');
        $email = $faker->unique()->email;
        
        $this
            ->visit('/create')      // このパスに対して試験を行う
            ->type('Hoge','title')
            ->type($email,'body')
            ->press('登録')
            ->see('Hoge');
        
        //check db
        $this->seeInDatabase('articles',['body'=>$email]);
    }

    public function testCreateNG()
    {
        //emailを生成
        $faker = Faker\Factory::create('ja_JP');
        $email = $faker->unique()->email;
        
        $this
            ->visit('/create')      // このパスに対して試験を行う
            ->type('','title')
            ->type($email,'body')
            ->press('登録')
            ->see('タイトルを入力してください。');

        //check db
        $this->seeInDatabase('articles',['body'=>$email]);
    }


}

class ExtendClass extends \App\Service\ArticleService
{
    /** @var bool */
    public $returning = true;

    /**
     * @return bool
     */
    protected function isFull()
    {
        return $this->returning;
    }
}
