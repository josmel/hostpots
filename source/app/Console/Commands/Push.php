<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use App\Models\Delivery;
use App\Models\Notification;
use App\Models\Platform;
use App\Models\Driver;
use Config;
use Carbon\Carbon;
use Log;

class Push extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'push';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'pusher';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
                $now = Carbon::now();
		$model = Delivery::where('delivery_type_id',2)->whereNull('datepublish')
                        ->whereBetween('datestart',[$now->subMinutes(2)->format('Y-m-d H:i:s'),$now->addMinute(3)->format('Y-m-d H:i:s')])->get();
                $data = $model->toArray();
                $driver = Driver::whereFlagactive(1)->get();
                Log::warning($now->format('Y-m-d H:i:s'));
                Log::warning($now->subMinutes(2)->format('Y-m-d H:i:s'));
                Log::warning($now->addMinute(3)->format('Y-m-d H:i:s'));
                Log::info('Cron funcionando');
                if(!empty($driver) && count($data)>0){
                    foreach ($driver as $value) {
                        foreach ($data as $objDelivery) {
                            Notification::create(array(
                                'type_id' => Notification::PUSH,
                                'platform_id' => Platform::ANDROID,
                                'user_id' => $value->id,
                                'app_id' => Config::get('app.APP_ID'),
                                'token' => \md5(\uniqid(\time())),
                                'description' => "{\"delivery_id\":\"{$objDelivery['id']}\",\"description\":\"Nuevo delivery\"}",
                                'appname' => Config::get('app.APP_NAME'),
                                'dbconfig' => Config::get('app.DB_CONFIG'),
                                'params' => "{\"delivery_id\":\"{$objDelivery['id']}\",\"description\":\"Nuevo delivery\"}",
                                'tosend' => $value->uuid,
                                'to' => 'Test',
                                'from' => 'Cligo',
                                'flagsend' => 0,
                                'flagactive' => 1,
                            ));
                            $del = Delivery::find($objDelivery['id']);
                            $del->datepublish = Carbon::now()->format('Y-m-d H:i:s');
                            $del->save();
                            
                            Log::info("Notificacion enviada del delivery id: {$objDelivery['id']}");
                        }
                    }
                }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
//	protected function getArguments()
//	{
//		return [
//			['example', InputArgument::REQUIRED, 'An example argument.'],
//		];
//	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
//	protected function getOptions()
//	{
//		return [
//			['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
//		];
//	}

}
