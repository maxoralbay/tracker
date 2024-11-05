SELECT d.id, d.domain, COUNT(v.id) AS visit_count,
       COUNT(CASE WHEN v.created_at >= DATE_SUB(NOW(), INTERVAL 1 MONTH) THEN 1 END) AS last_month_visits,
       COUNT(c.id) AS contact_count,
       COUNT(DISTINCT v.id) AS unique_visitors,
       MAX(c.created_at) AS last_contact_date
FROM domain d
         JOIN user u ON d.user_id = u.id
         LEFT JOIN visit v ON d.id = v.domain_id
         LEFT JOIN contact c ON v.id = c.visit_id
WHERE d.created_at >= DATE_SUB(NOW(), INTERVAL 1 WEEK)
  AND u.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
  AND d.id NOT IN (SELECT domain_id FROM blacklist)
GROUP BY d.id
HAVING COUNT(DISTINCT d.id) >= 2 AND visit_count >= 1