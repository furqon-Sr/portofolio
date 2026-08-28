<?php
try {
    undefined_function();
} catch (\Throwable $e) {
    echo "Caught: " . $e->getMessage() . "\n";
}
