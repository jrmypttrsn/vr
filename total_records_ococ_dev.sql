SELECT SUM(TABLE_ROWS) 
FROM 
    `information_schema`.`tables` 
WHERE 
    `table_schema` = 'ococ_dev';