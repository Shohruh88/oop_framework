SELECT
YEAR(paymentDate) as yil,
sum(amount) as Jami
from payments
group by YEAR(paymentDate)
ORDER BY yil, sum(amount);

