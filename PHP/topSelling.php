






SELECT TOP $TopNum P.upc, sum(P.quantity) AS 'Quantities Sold'
FROM PurchaseItem P, Order O
WHERE P.receiptid=O.receiptid, O.date='$date'
GROUP BY P.upc
ORDER BY sum(P.quantity) DESC
