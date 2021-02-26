CREATE TABLE  Publicacoes{
    id NUMERIC (10000) ,
    dono VARCHAR (50),
    imagem varbinary(max),
    participantes VARCHAR (50),
    descricao VARCHAR (150),

    CONSTRAINT pk_publicacoes 
        PRIMARY KEY (id),
        
    CONSTRAINT fk_dono_publicacoes 
        FOREIGN KEY (dono) REFERENCES (Publicacoes)
}

CREATE TABLE  Participa_em_publicacao{
    id NUMERIC (10000);
    participante VARCHAR (50);
    
}

CREATE TABLE  Publicacoes{
    id NUMERIC (10000) ,
    dono VARCHAR (50),
    imagem varbinary(max),
    participantes VARCHAR (50),
    descricao VARCHAR (150),
