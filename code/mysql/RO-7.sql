


USE reorder;

INSERT INTO sys_config (config_key, description, value)
SELECT 'reorder_api_key','ReOrder API Key', 'ab4f1e8d-8de2-4bc4-9fbd-4868f61450f0'
FROM sys_config
WHERE NOT EXISTS (
  SELECT * FROM sys_config WHERE config_key = 'reorder_api_key'
)
LIMIT 1
;






