# Command line options

### Quick testing

```
phinder --quicktest <pattern>  # Find <pattern> in your code
```

**Sample usage:**

```
phinder --quicktest 'in_array(_, _)'
phinder --quicktest 'var_dump(...)'
```

### JSON output

```
phinder --json  # Ouput results in json format
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

### Specify rule path

```
phinder --rule <file>  # Use <file> instead of phinder.yml
phinder --rule <dir>   # Use all yml files in <dir>
```

### Specify PHP file path

```
phinder --php <file>  # Find pieces in <file>
phinder --php <dir>   # Find pieces in all php files in <dir>
```
