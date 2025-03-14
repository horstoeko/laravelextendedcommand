<?php

/**
 * This file is a part of horstoeko/laravelextendedcommand.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\laravelextendedcommand;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

/**
 * Class representing an extended console command for laravel
 *
 * @category Laravel Extended Command
 * @package  Laravel Extended Command
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/laravelextendedcommand
 */
class ExtendedCommand extends Command
{
    /**
     * The validated options
     *
     * @var array
     */
    private $validatedOptions = [];

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
        if (!$this->validateOptions()) {
            return 1;
        }

        return $this->executeCommand();
    }

    /**
     * Execute business logic
     *
     * @return integer
     */
    protected function executeCommand(): int
    {
        return Command::SUCCESS;
    }

    /**
     * Returns a list of all options which must be validated
     *
     * @return array
     */
    protected function getOptionsToValidate(): array
    {
        return [];
    }

    /**
     * Validate options
     *
     * @return bool
     */
    protected function validateOptions(): bool
    {
        $validator = Validator::make($this->options() + $this->arguments(), $this->getOptionsToValidate());

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return false;
        }

        $this->validatedOptions = $validator->validated();

        return true;
    }

    /**
     * Get the validated option value
     *
     * @param  string $key
     * @param  mixed  $default
     * @return mixed
     */
    protected function validatedOption(string $key, $default = null)
    {
        return $this->validatedOptions[$key] ?? $default;
    }

    /**
     * Get all the validated option values
     *
     * @return array
     */
    protected function validatedOptions(): array
    {
        return $this->validatedOptions;
    }
}
