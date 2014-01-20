<?php
/**
 * User: inpu
 * Date: 18.01.14
 * Time: 23:29
 */

namespace bc\cmf;

use bc\config\ConfigManager;
use Slim\Extras\Views\Twig;
use Slim\Slim;

class Application
{

    /**
     * @var \Slim\Slim
     */
    private $slim;

    public function __construct($settings = array()) {

        $cfg = isset($settings['config_file'])
            ? ConfigManager::get($settings['config_file'])
            : ConfigManager::get("config/app");

        $settings = array_merge($settings, $cfg->getAll());

        if (isset($settings['twig'])) {
            Twig::$twigOptions = $settings['twig'];
        }
        Twig::$twigExtensions = array(
            'Twig_Extensions_Slim',
        );

        $twig = new Twig();

        $settings['view'] = $twig;

        $this->slim = new Slim($settings);
        $this->initRoutes();
    }

    public function run() {
        $this->slim->run();
    }

    protected function initRoutes() {

    }

    /**
     * @return \Slim\Slim
     */
    public final function getSlim() {
        return $this->slim;
    }

    /**
     * @param $pattern
     * @param Command $command
     * @return \Slim\Route
     */
    protected function addGetCommand($pattern, Command $command) {
        $command->setApp($this);

        return $this->slim->get($pattern, $command->getCallback());
    }

    /**
     * @param $pattern
     * @param Command $command
     * @return \Slim\Route
     */
    protected function addPostCommand($pattern, Command $command) {
        $command->setApp($this);
        return $this->slim->post($pattern, $command->getCallback());
    }
}