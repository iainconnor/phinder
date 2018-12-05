# Phinder: PHP Code Piece Finder

Phinder is a tool to find code pieces (technically PHP expressions).
This tool aims mainly at speeding up your code review process, not static bug detection.

---

Suppose that your project has the following local rule:

- Specify the 3rd parameter explicitly when calling `in_array` to avoid unexpected comparison results.

Your project code follows this rule unless you forget to check it in code review. But what if you forget? What if your project has ten rules? You probably want machines to do such low-level checking.

Phinder is a command line tool for checking such low-level things automatically. By saving the following yml as `phinder.yml` and running `phinder` from your terminal, Phinder finds the violations for you:

```yml
- id: in_array_without_3rd_param
  pattern: in_array(_, _)
  message: Specify the 3rd parameter explicitly when calling `in_array` to avoid unexpected comparison results.
```

## Installation

```console
composer global require sider/phinder
```

You can check your installation by the following command:

```console
~/.composer/vendor/bin/phinder --help
```

If you have `$HOME/.composer/vendor/bin` in your PATH, you can also check it by the following:

```console
phinder --help
```

## Command Line Options

### Quick Test

```console
phinder --quicktest <pattern>
```

**Sample Usage:**

```console
phinder --quicktest 'in_array(_, _)'
phinder --quicktest 'var_dump(...)'
```

### JSON Output

```console
phinder --json
```

**Sample Output:**

```json
{
  "result": [
    {
      "path": "./index.php",
      "rule": {
        "id": "sample.var_dump",
        "message": "Do not use var_dump."
      },
      "location": {
        "start": [4, 5],
        "end": [4, 21]
      }
    }
  ],
  "errors": []
}
```

### Rule Path

```console
phinder --rule <file>  # Use <file> instead of phinder.yml
phinder --rule <dir>   # Use all yml files in <dir>
```

### PHP Path

```console
phinder --php <file>  # Find pieces in <file>
phinder --php <dir>   # Find pieces in all php files in <dir>
```

### Help

```console
phinder --help
```

## Test

```console
phinder test
```

## Pattern Syntax

Any PHP expression is a valid Phinder pattern.
Phinder currently supports two kinds of wildcards:

- `_`: any single expression
- `...`: variable length arguments or array pairs

For example, `foo(_)` means an invocation of `foo` with one argument.
`bar(_, _, ...)` means an invocation of `bar` with two or more arguments.
More features will be added such as statement search.

## Contributing

Bug reports and pull requests are welcome on GitHub at [https://github.com/sider/phinder](https://github.com/sider/phinder).

## Acknowledgements

Phinder is inspired by [Querly](https://github.com/soutaro/querly/), [ast-grep](https://github.com/azz/ast-grep), and [ASTsearch](https://github.com/takluyver/astsearch).
The implementation depends largely on [PHP-Parser](https://github.com/nikic/PHP-Parser) and [kmyacc-forked](https://github.com/moriyoshi/kmyacc-forked/).
