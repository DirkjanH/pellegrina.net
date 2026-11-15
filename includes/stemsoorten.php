<?php

function normaliseer_stemsoorten($waarde): array
{
    if ($waarde === null || $waarde === '' || $waarde === 0 || $waarde === '0') return [];
    if (is_string($waarde) || is_int($waarde)) {
        $waarde = explode(',', (string)$waarde);
    }
    if (!is_array($waarde)) {
        throw new InvalidArgumentException('Invalid voice selection.');
    }

    $toegestaan = ['10', '11', '20', '21', '30', '31', '40', '50', '51', '60', '61', '70', '71'];
    $stemsoorten = [];
    foreach ($waarde as $stem) {
        if (!is_string($stem) && !is_int($stem)) {
            throw new InvalidArgumentException('Invalid voice selection.');
        }
        $stem = trim((string)$stem);
        if (!in_array($stem, $toegestaan, true)) {
            throw new InvalidArgumentException('Invalid voice selection.');
        }
        $stemsoorten[] = $stem;
    }
    return array_values(array_unique($stemsoorten));
}
