<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Symfony\Component\Console\Input\InputOption;

class IdeHelperServiceMeta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ide-helper:meta-with-services';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $methods = [
        '\App\Commons\Helpers\ServiceHelper::make(0)'
    ];

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
     * @return int
     */
    public function handle()
    {
        $this->call('ide-helper:meta', $this->arguments());
        $filename = $this->option('filename');
        $services = $this->getServices();
        $maps = $this->makeMaps($services);

        $contents = '';

        foreach ($this->methods as $method) {
            foreach ($this->makeContent($method, $maps) as $row) {
                $contents .= '    ' . $row . "\n";
            }
        }

        $contents .= $this->otherDefinitions();
        $contents .= "\n";

        $this->writeTo($filename, $contents);

        $this->info('added services to .phpstorm.meta.php');
    }

    private function getServices()
    {
        $fs = app('files');

        return collect(config('ide-helper.service_directories'))
            ->flatMap(function ($dir) use ($fs) {
                return $fs->allFiles($dir);
            })
            ->filter(function (\SplFileInfo $file) {
                return strtolower($file->getExtension()) === 'php' && strtolower(substr($file->getBasename('.php'), -7)) === 'service';
            })
            ->map(function (\SplFileInfo $file) {
                preg_match('/namespace\s+([\w\\\]+Services[\w\\\]*)/i', file_get_contents($file->getRealPath()), $matches);
                if (isset($matches[1])) {
                    return '\\' . ltrim($matches[1], '\\') . '\\' . $file->getBasename('.php');
                }
                return null;
            })
            ->filter(function ($file) {
                return !!$file;
            });
    }

    private function makeMaps(Collection $services)
    {
        $maps = [];

        foreach ($services as $cls) {
            $sp = explode('\\', trim($cls, '\\'));

            // 特殊处理，如果是 App\Services 可以省略 App\Services 前缀
            if (strtolower($sp[0]) === 'app' && strtolower($sp[1]) === 'services') {
                $sp = array_slice($sp, 2);
            }

            $maps[join('\\', $sp)] = $cls;
            $maps[join('\\\\', $sp)] = $cls;
        }

        return $maps;
    }

    private function makeContent($method, $maps)
    {
        $content = [];
        $content[] = "override({$method}, map([";
        $content[] = "    '' => '@',";
        foreach ($maps as $k => $v) {
            $content[] = "    '{$k}' => {$v}::class,";
        }
        $content[] = ']));';
        $content[] = "";

        return $content;
    }

    private function writeTo($filename, $content)
    {
        $str = file_get_contents($filename);
        $i = strripos($str, '}');
        if ($i !== false) {
            $str = substr($str, 0, $i) . $content . '}' . substr($str, $i + 1);
            file_put_contents($filename, $str);
        }
    }

    protected function getOptions()
    {
        $filename = config('ide-helper.meta_filename');

        return [
            ['filename', 'F', InputOption::VALUE_OPTIONAL, 'The path to the meta file', $filename],
        ];
    }

    private function otherDefinitions()
    {
        return <<<EOT
    override(\App\Commons\Helpers\RequestHelper::makeDTO(0), type(0));
EOT;

    }
}
