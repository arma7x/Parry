<?php
namespace App\Libraries\Filters;

use CodeIgniter\Filters\Filters as BaseFilters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Modules;

class Filters extends BaseFilters
{
    public function __construct($config, RequestInterface $request, ResponseInterface $response, ?Modules $modules = null)
    {
        parent::__construct($config, $request, $response, $modules);
    }

    public function enableFilter(string $names, string $when = 'before')
    {
        $names = explode('|', $names);
        foreach($names as $name) {
          // Get parameters and clean name
          if (strpos($name, ':') !== false) {
              [$name, $params] = explode(':', $name);

              $params = explode(',', $params);
              array_walk($params, static function (&$item) {
                  $item = trim($item);
              });

              $this->arguments[$name] = $params;
          }

          if (class_exists($name)) {
              $this->config->aliases[$name] = $name;
          } elseif (! array_key_exists($name, $this->config->aliases)) {
              throw FilterException::forNoAlias($name);
          }

          $classNames = (array) $this->config->aliases[$name];

          foreach ($classNames as $className) {
              $this->argumentsClass[$className] = $this->arguments[$name] ?? null;
          }

          if (! isset($this->filters[$when][$name])) {
              $this->filters[$when][]    = $name;
              $this->filtersClass[$when] = array_merge($this->filtersClass[$when], $classNames);
          }
        }

        return $this;
    }

}
