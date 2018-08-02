<?php

namespace Phinder\Parser;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;
use Phinder\Error\{InvalidPattern,InvalidRule,InvalidYaml};
use Phinder\Rule;
use function Funct\Strings\endsWith;


final class RuleParser extends FileParser {

    private $patternParser;

    public function __construct() {
        $this->patternParser = new PatternParser;
    }

    protected function support($path) {
        return endsWith($path, '.yml');
    }

    protected function parseFile($path) {
        $code = $this->getContent($path);
        try {
            $rules = Yaml::parse($code);
        } catch (ParseException $e) {
            throw new InvalidYaml($path);
        }
        if (!\is_array($rules)) {
            throw new InvalidYaml($path);
        }

        for ($i=0; $i<\count($rules); $i++) {
            $arr = $rules[$i];

            try {
                foreach (static::parseArray($arr, $i, $path) as $r) {
                    yield $r;
                }
            } catch (InvalidPattern $e) {
                $e->path = $path;
                throw $e;
            } catch (InvalidRule $e) {
                $e->path = $path;
                $e->index = $i + 1;
                throw $e;
            }
        }
    }

    private function parseArray($arr) {
        $id = $arr['id'];
        $pattern = $arr['pattern'];
        $message = $arr['message'];

        if (!\is_string($id)) {
            throw new InvalidRule('id');
        }

        if (!\is_string($message)) {
            throw new InvalidRule('message');
        }

        if (!\is_string($pattern) && !\is_array($pattern)) {
            throw new InvalidRule('pattern');
        }

        $arr = \is_array($pattern)? $pattern : [$pattern];

        try {
            foreach ($this->patternParser->parse($arr) as $xpath) {
                yield new Rule($id, $xpath, $message);
            }
        } catch (InvalidPattern $e) {
            $e->id = $id;
            throw $e;
        }
    }

}