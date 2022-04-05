<?php

namespace Tests\Unit;

use Database\Seeders\TestUserAnswerSeeder;
use Tests\CreatesApplication;
use Tests\TestCase;

use App\Console\Commands;

class FlashcardConsoleTest extends TestCase
{
    use CreatesApplication;

    /**
     * Run a specific seeder before each test.
     *
     * @var string
     */
    protected string $seeder = TestUserAnswerSeeder::class;

    /**
     * Run a specific seeder before each test.
     *
     * @var mixed
     */
    protected mixed $flashcard;

    /**
     * init
     *
     * @return void
     */
    public function setUp():void
    {
        parent::setUp();
        $this->flashcard = $this->mock(Commands\Flashcard::class);
    }

    /**
     * init
     *
     * @return void
     */
    public function tearDown():void
    {

    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetStatClass():void
    {
        $this->assertTrue(true);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetHistoryClass():void
    {
        $this->assertTrue(true);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testListCardClass():void
    {
        $this->assertTrue(true);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testCreateCardClass():void
    {
        $this->assertTrue(true);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testInitPracticeClass():void
    {
        $this->assertTrue(true);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testPromptClass():void
    {
        $this->assertTrue(true);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testResetClass():void
    {
        $this->assertTrue(true);
    }
}
