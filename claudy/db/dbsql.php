<!--SELECT Orders.OrderID, Customers.CustomerName-->
<!--FROM Orders-->
<!--INNER JOIN Customers ON Orders.CustomerID = Customers.CustomerID;-->




#left Join
SELECT Orders.OrderID, Customers.CustomerName
FROM Orders
INNER JOIN Customers ON Orders.CustomerID = Customers.CustomerID;