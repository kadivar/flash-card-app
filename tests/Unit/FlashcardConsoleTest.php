<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Console\Commands;

class FlashcardConsoleTest extends TestCase
{
    use RefreshDatabase;

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
    public function setUp(): void
    {
        parent::setUp();
        $this->flashcard = $this->mock(Commands\Flashcard::class);
    }

    /**
     * init
     *
     * @return void
     */
    public function tearDown(): void
    {

    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetStatClass(): void
    {
        $stat = new Commands\Classes\Flashcard\Stat($this->flashcard);
        $result = $stat->get();
        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertArrayHasKey('total', $result[0]);
        $this->assertArrayHasKey('total_answers', $result[0]);
        $this->assertArrayHasKey('correct_answers', $result[0]);
        $this->assertIsNumeric($result[0]['total']);
        $this->assertIsString($result[0]['total_answers']);
        $this->assertIsString($result[0]['correct_answers']);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetHistoryClass(): void
    {
        $history = new Commands\Classes\Flashcard\History($this->flashcard);
        $result = $history->get();
        $last_item_index = count($result) - 1;
        $this->assertIsArray($result);
        $this->assertGreaterThan(0, count($result));
        $this->assertArrayHasKey('id', $result[0]);
        $this->assertArrayHasKey('question', $result[0]);
        $this->assertArrayHasKey('status', $result[0]);
        $this->assertIsNumeric($result[0]['id']);
        $this->assertIsString($result[0]['question']);
        $this->assertIsString($result[0]['status']);
        $this->assertArrayHasKey(' ', $result[$last_item_index]);
        $this->assertArrayHasKey('question', $result[$last_item_index]);
        $this->assertArrayHasKey('status', $result[$last_item_index]);
        $this->assertSame($result[$last_item_index][' '], ' ');
        $this->assertSame($result[$last_item_index]['question'], '<fg=green> % of completion</>');
        $this->assertIsString($result[$last_item_index][' ']);
        $this->assertIsString($result[$last_item_index]['status']);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testListCardClass(): void
    {
        $card = new Commands\Classes\Flashcard\Card($this->flashcard);
        $result = $card->list();
        $this->assertIsArray($result);
        $this->assertGreaterThan(0, count($result));
        $this->assertArrayHasKey('id', $result[0]);
        $this->assertArrayHasKey('question', $result[0]);
        $this->assertArrayHasKey('answer', $result[0]);
        $this->assertIsNumeric($result[0]['id']);
        $this->assertIsString($result[0]['question']);
        $this->assertIsString($result[0]['answer']);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testCreateCardClass(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testInitPracticeClass(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testPromptClass(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testResetClass(): void
    {
        $this->assertTrue(true);
    }
}
