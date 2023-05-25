<?php

namespace QB;

class Select
{
    use QuotableTrait;

    public string $query = '';

    public array $wheres = [];

    public function __construct(
        protected string $table
    )
    {
        $this->query = "select * from " . $this->quote($this->table);
    }

    public function toSql(): string
    {
        if (!empty($this->wheres)) {
            $this->wheresToQuery();
        }

        return $this->query;
    }

    public function __toString()
    {
        return $this->toSql();
    }

    public function where(string $field, string $operator, string $value): self
    {
        $this->wheres[] = compact('field', 'operator', 'value');
        return $this;
    }

    protected function wheresToQuery(): void
    {
        $wheres = $this->wheres;
        $wheres = $this->arrangeCondition($wheres);

        $this->query .= " where " . implode(((count($this->wheres )> 1) ? ' and ' : ' '), $wheres);
    }

    protected function arrangeCondition(array $condition)
    {
        return array_map(fn($condition) => $this->quote($condition['field']) . " {$condition['operator']} :{$condition['field']}", $condition);
    }

}