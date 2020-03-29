# RUVENTS Doctrine Fixes Bundle +

## Installation

1. Install the package via composer:
   ```console
   $ composer require omasn/doctrine-fixes-bundle
   ```

1. Register the bundle:
    ```php
    <?php
    // app/AppKernel.php
    
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = [
                // ...
                new Ruvents\DoctrineFixesBundle\RuventsDoctrineFixesBundle(),
            ];
        }
    }
    ```

## Configuration

```yaml
# app/Resources/config.yml

ruvents_doctrine_fixes:
    # connection name
    default:
        # all fixes are disabled by default and can be enabled with null
        schema_namespace_fix: ~
        default_value_fix:
            # equivalent default values
            aliases:
                - { value1: 'now()', value2: 'CURRENT_TIMESTAMP' }
    
    another_connection:
        # ...
```

## Fixes

### Schema namespace fix ([doctrine/dbal#1110](https://github.com/doctrine/dbal/issues/1110))

```yaml
        # ...
        schema_namespace_fix:
            # namespace is null by default
            # $platform->getDefaultSchemaName() is used in this case
            namespace: 'public'
```

### Datetime default fix

```yaml
        # ...
        default_value_fix:
            # equivalent default values
            aliases:
                - { value1: 'now()', value2: 'CURRENT_TIMESTAMP' }
```
