![alt text](image.png)

depois fiz a conexao com o conexao.php
![alt text](image-1.png)

Agora configurei o pecas.php
![alt text](image-2.png)

testei o POST e deu certo
![alt text](image-3.png)

O GET
![alt text](image-5.png)

DELETE
![alt text](image-6.png)

coloquei 12 produtos
![alt text](image-4.png)



quanyas unidades existem no almoxarifado?
```sql
SELECT SUM(quantidade) AS total_unidades
FROM pecas;
```

Qual o valor total do estoque?
```sql
SELECT SUM(quantidade * preco_unitario) AS valor_total_estoque
FROM pecas;
```

Preço da peça mais cara
```sql
SELECT MAX(preco_unitario) AS maior_preco
FROM pecas;
```

Preço médio com duas casas decimais
```sql
SELECT ROUND(AVG(preco_unitario), 2) AS preco_medio
FROM pecas;
```

Valor total em estoque somente da categoria elétrica
```sql
SELECT SUM(quantidade * preco_unitario) AS valor_total_eletrica
FROM pecas
WHERE categoria = 'eletrica';
```