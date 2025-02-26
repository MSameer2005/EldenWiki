SELECT a.nome AS nome_arma,
       a.descrizione,
       a.immagine,
       a.peso,
       a.ottenimento,
       c.nome AS categoria,
       GROUP_CONCAT(
               DISTINCT CONCAT(t.nome, ' ', IFNULL(s.valore, 0))
               ORDER BY FIELD(t.nome, 'Fisico', 'Magico', 'Fuoco', 'Fulmine', 'Sacro', 'Critico')
       )      AS attacco,
       GROUP_CONCAT(
               DISTINCT CONCAT(t2.nome, ' ', IFNULL(d.valore, 0))
               ORDER BY FIELD(t2.nome, 'Fisico', 'Magico', 'Fuoco', 'Fulmine', 'Sacro', 'Critico', 'Boost')
       )      AS difesa,
       GROUP_CONCAT(
               DISTINCT CONCAT(at.nome, ' ', IFNULL(sc.grado_scaling, '-'))
               ORDER BY FIELD(at.nome, 'Forza', 'Destrezza', 'Intelligenza', 'Fede', 'Arcano')
       )      AS scaling,
       GROUP_CONCAT(
               DISTINCT CONCAT(at.nome, ' ', IFNULL(sc.parametro, 0))
               ORDER BY FIELD(at.nome, 'Forza', 'Destrezza', 'Intelligenza', 'Fede', 'Arcano')
       )      AS requisiti,
       GROUP_CONCAT(
               DISTINCT CONCAT(ef.icona, '<br>', e.nome_effetto)
       )      AS effetto_passivo
FROM Armi a
         JOIN Categorie c ON a.id_categoria = c.id_categoria
         LEFT JOIN Statistiche s ON a.id_arma = s.id_arma AND s.tipologia = 'ATT'
         LEFT JOIN TipiStatistiche t ON s.id_tipo = t.id_tipo
         LEFT JOIN Statistiche d ON a.id_arma = d.id_arma AND d.tipologia = 'DEF'
         LEFT JOIN TipiStatistiche t2 ON d.id_tipo = t2.id_tipo
         LEFT JOIN Scaling sc ON a.id_arma = sc.id_arma
         LEFT JOIN Attributi at ON sc.id_attributo = at.id_attributo
         LEFT JOIN armieffetti e ON a.id_arma = e.id_arma
         LEFT JOIN effettistato ef ON e.nome_effetto = ef.nome
GROUP BY a.id_arma, a.nome, a.descrizione, a.immagine, a.peso, a.ottenimento, c.nome;

-- View
CREATE VIEW ViewArmi AS
SELECT a.id_arma AS id,
       a.nome    AS nome_arma,
       a.descrizione,
       a.immagine,
       a.peso,
       a.ottenimento,
       c.nome    AS categoria,
       GROUP_CONCAT(
               DISTINCT CONCAT(t.nome, ' ', IFNULL(s.valore, 0))
               ORDER BY FIELD(t.nome, 'Fisico', 'Magico', 'Fuoco', 'Fulmine', 'Sacro', 'Critico')
       )         AS attacco,
       GROUP_CONCAT(
               DISTINCT CONCAT(t2.nome, ' ', IFNULL(d.valore, 0))
               ORDER BY FIELD(t2.nome, 'Fisico', 'Magico', 'Fuoco', 'Fulmine', 'Sacro', 'Critico', 'Boost')
       )         AS difesa,
       GROUP_CONCAT(
               DISTINCT CONCAT(at.nome, ' ', IFNULL(sc.grado_scaling, '-'))
               ORDER BY FIELD(at.nome, 'Forza', 'Destrezza', 'Intelligenza', 'Fede', 'Arcano')
       )         AS scaling,
       GROUP_CONCAT(
               DISTINCT CONCAT(at.nome, ' ', IFNULL(sc.parametro, 0))
               ORDER BY FIELD(at.nome, 'Forza', 'Destrezza', 'Intelligenza', 'Fede', 'Arcano')
       )         AS requisiti,
       GROUP_CONCAT(
               DISTINCT CONCAT(ef.icona, '<br>', e.nome_effetto)
       )         AS effetto_passivo
FROM Armi a
         JOIN Categorie c ON a.id_categoria = c.id_categoria
         LEFT JOIN Statistiche s ON a.id_arma = s.id_arma AND s.tipologia = 'ATT'
         LEFT JOIN TipiStatistiche t ON s.id_tipo = t.id_tipo
         LEFT JOIN Statistiche d ON a.id_arma = d.id_arma AND d.tipologia = 'DEF'
         LEFT JOIN TipiStatistiche t2 ON d.id_tipo = t2.id_tipo
         LEFT JOIN Scaling sc ON a.id_arma = sc.id_arma
         LEFT JOIN Attributi at ON sc.id_attributo = at.id_attributo
         LEFT JOIN armieffetti e ON a.id_arma = e.id_arma
         LEFT JOIN effettistato ef ON e.nome_effetto = ef.nome
GROUP BY a.id_arma, a.nome, a.descrizione, a.immagine, a.peso, a.ottenimento, c.nome;
