-- Lista de funcionários ordenando pelo salário decrescente:
SELECT * FROM VENDEDORES
ORDER BY salario DESC;

-- Lista de pedidos de vendas ordenados por data de emissão:

SELECT * FROM PEDIDO
ORDER BY data_emissao;

-- Valor de faturamento por cliente:

SELECT c.id_cliente, c.razao_social AS cliente, SUM(ip.preco_praticado * ip.quantidade) AS faturamento
FROM CLIENTES c
JOIN PEDIDO p ON c.id_cliente = p.id_cliente
JOIN ITENS_PEDIDO ip ON p.id_pedido = ip.id_pedido
GROUP BY c.id_cliente, c.razao_social
ORDER BY faturamento DESC;

-- Valor de faturamento por empresa:

SELECT e.id_empresa, e.razao_social AS empresa, SUM(ip.preco_praticado * ip.quantidade) AS faturamento
FROM EMPRESA e
JOIN PEDIDO p ON e.id_empresa = p.id_empresa
JOIN ITENS_PEDIDO ip ON p.id_pedido = ip.id_pedido
GROUP BY e.id_empresa, e.razao_social
ORDER BY faturamento DESC;

-- Valor de faturamento por vendedor:

SELECT v.id_vendedor, v.nome AS vendedor, SUM(ip.preco_praticado * ip.quantidade) AS faturamento
FROM VENDEDORES v
JOIN CLIENTES c ON v.id_vendedor = c.id_vendedor
JOIN PEDIDO p ON c.id_cliente = p.id_cliente
JOIN ITENS_PEDIDO ip ON p.id_pedido = ip.id_pedido
GROUP BY v.id_vendedor, v.nome
ORDER BY faturamento DESC;

