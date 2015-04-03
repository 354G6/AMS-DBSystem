






SELECT TOP $TopNum upc, sum(quantity)
FROM PurchaseItem P, Order O
WHERE P.receiptid=O.receiptid, O.date='$date'
GROUP BY upc
ORDER BY sum(quantity) DESC
