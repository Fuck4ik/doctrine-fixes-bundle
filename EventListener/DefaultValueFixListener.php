<?php

namespace Ruvents\DoctrineFixesBundle\EventListener;

use Doctrine\DBAL\Event\SchemaAlterTableChangeColumnEventArgs;

class DefaultValueFixListener
{
    /**
     * @var array
     */
    private $aliases;

    /**
     * @param array $aliases
     */
    public function __construct($aliases = [])
    {
        $this->aliases = $aliases;
    }

    /**
     * @param SchemaAlterTableChangeColumnEventArgs $args
     */
    public function onSchemaAlterTableChangeColumn(SchemaAlterTableChangeColumnEventArgs $args)
    {
        if (empty($this->aliases)) {
            return;
        }

        $columnDiff = $args->getColumnDiff();
        $compareDefaultValues = $this->prepareDefaultValues([
            $columnDiff->column->getDefault(),
            $columnDiff->fromColumn->getDefault()
        ]);

        foreach ($this->aliases as $valueAliases) {
            $aliasDefaultValues = $this->prepareDefaultValues($valueAliases);

            if ([] === array_diff($compareDefaultValues, $aliasDefaultValues)) {
                $args->preventDefault();
                return;
            }
        }
    }

    private function prepareDefaultValues($values)
    {
        $defaultValues = array_values($values);
        $defaultValues[0] = strtolower($defaultValues[0]);
        $defaultValues[1] = strtolower($defaultValues[1]);

        return $defaultValues;
    }
}
