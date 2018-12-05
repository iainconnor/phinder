# Command line options

## Quick test

```console
phinder --quicktest <pattern>
```

**Sample usage:**

```console
phinder --quicktest 'in_array(_, _)'
phinder --quicktest 'var_dump(...)'
```

## JSON output

```console
phinder --json
```

**Sample output:**

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

## Specify rule path

```console
phinder --rule <file>  # Use <file> instead of phinder.yml
phinder --rule <dir>   # Use all yml files in <dir>
```

## Specify PHP file path

```console
phinder --php <file>  # Find pieces in <file>
phinder --php <dir>   # Find pieces in all php files in <dir>
```

## Help

```console
phinder --help
```

## Test

```console
phinder test
```
