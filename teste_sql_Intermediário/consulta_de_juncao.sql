WITH UltimoPedidoCliente AS (
    -- Encontrando a última data de emissão para cada cliente e produto
    SELECT
        p.id_cliente,
        p.id_produto,
        MAX(p.data_emissao) AS ultima_data_emissao
    FROM PEDIDO p
    GROUP BY p.id_cliente, p.id_produto
)

    -- Selecionando os campos necessários
SELECT
    cp.id_produto,
    pr.descricao,
    p.id_cliente,
    c.razao_social AS razao_social_cliente,
    p.id_empresa,
    e.razao_social AS razao_social_empresa,
    p.id_vendedor,
    v.nome AS nome_vendedor,
    cp.preco_minimo,
    cp.preco_maximo,
    ip.preco_praticado AS preco_base
FROM UltimoPedidoCliente upc
JOIN PEDIDO p ON upc.id_cliente = p.id_cliente AND upc.id_produto = p.id_produto AND upc.ultima_data_emissao = p.data_emissao
JOIN ITENS_PEDIDO ip ON p.id_pedido = ip.id_pedido AND p.id_produto = ip.id_produto
JOIN PRODUTOS pr ON p.id_produto = pr.id_produto
JOIN CLIENTES c ON p.id_cliente = c.id_cliente
JOIN EMPRESA e ON p.id_empresa = e.id_empresa
JOIN VENDEDORES v ON p.id_vendedor = v.id_vendedor
JOIN CONFIG_PRECO_PRODUTO cp ON ip.id_vendedor = cp.id_vendedor AND ip.id_empresa = cp.id_empresa AND ip.id_produto = cp.id_produto
ORDER BY p.id_cliente, p.id_produto;