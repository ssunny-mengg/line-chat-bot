<?php

namespace App\Console\Commands;

use App\Http\Controllers\LineWebHookController;
use Illuminate\Console\Command;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class pushMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'push:message {userId} {message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send a message to a user';

    /**
     * Execute the console command.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle()
    {
        $message = $this->argument('message');
        $userId = $this->argument('userId');

        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(env('LINE_CHANNEL_ACCESS_TOKEN'));
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => env('LINE_CHANNEL_SECRET')]);

        $packageId = 2;
        $stickerId = 154;

        $multiMessageBuilder = new MultiMessageBuilder();
        $multiMessageBuilder->add(new TextMessageBuilder($message));
        $multiMessageBuilder->add(new StickerMessageBuilder($packageId, $stickerId));
        $response = $bot->pushMessage($userId, $multiMessageBuilder);
    }
}
