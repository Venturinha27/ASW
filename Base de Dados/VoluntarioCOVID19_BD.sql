-- ----------------------------------------------------------------------------
-- ASW 2020/21 – 54984, Tiago Teodoro
--             – 54959, Gonçalo Cruz
--             – 54974, Renato Ramires
--             – 55141, Margarida Rodrigues
-- ----------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS Mensagem;
DROP TABLE IF EXISTS Participa_em_Publicacao;
DROP TABLE IF EXISTS Publicacao;
DROP TABLE IF EXISTS Participou_Acao;
DROP TABLE IF EXISTS Acao;
DROP TABLE IF EXISTS Voluntario_Disponibilidade;
DROP TABLE IF EXISTS Voluntario_Populacao_Alvo;
DROP TABLE IF EXISTS Populacao_Alvo;
DROP TABLE IF EXISTS Voluntario_Area;
DROP TABLE IF EXISTS Area_de_Interesse;
DROP TABLE IF EXISTS Voluntario;
DROP TABLE IF EXISTS Instituicao;
DROP TABLE IF EXISTS Utilizador;

/* ----------------------- UTILIZADOR ----------------------- */

CREATE TABLE  Utilizador (
    id      NUMERIC(65),
    tipo    VARCHAR(50) NOT NULL,
--
    CONSTRAINT pk_utilizador_id
        PRIMARY KEY (id),
--
    CONSTRAINT utilizador_tipo
        CHECK (tipo = "voluntario" OR tipo = "instituicao")
);

/* ----------------------- INSTITUICAO ----------------------- */

CREATE TABLE Instituicao (
    id                      NUMERIC(65),
    nome_instituicao        VARCHAR(15) UNIQUE NOT NULL,
    descricao               VARCHAR(240) NOT NULL,
    telefone                NUMERIC(15) NOT NULL,
    morada                  VARCHAR(100) NOT NULL,
    distrito                VARCHAR(50) NOT NULL,
    concelho                VARCHAR(50) NOT NULL,
    freguesia               VARCHAR(50) NOT NULL,
    email                   NVARCHAR(255) NOT NULL,
    website                 VARCHAR(50) NOT NULL,
    nome_representante      VARCHAR(15) NOT NULL,
    email_representante     NVARCHAR(255) NOT NULL,
    password2               VARCHAR(20) NOT NULL,

    CONSTRAINT pk_instituicao_id
        PRIMARY KEY (id),

    CONSTRAINT fk_instituicao_id
        FOREIGN KEY (id) REFERENCES Utilizador(id)
);

/* ----------------------- VOLUNTARIO ----------------------- */

CREATE TABLE Voluntario (
    id                      NUMERIC(65),
    nome_voluntario         VARCHAR(80) NOT NULL,
    data_nascimento         DATE NOT NULL,
    genero                  VARCHAR(255) NOT NULL,
    foto                    VARBINARY(65535) NOT NULL,
    concelho                VARCHAR(50) NOT NULL,
    distrito                VARCHAR(50) NOT NULL,
    freguesia               VARCHAR(50) NOT NULL,
    telefone                NUMERIC(15) NOT NULL,
    cc                      NUMERIC(8) NOT NULL UNIQUE,
    carta_c                 VARCHAR(255) NOT NULL,
    covid                   VARCHAR(255) NOT NULL,
    email                   NVARCHAR(255) NOT NULL,
    password1               VARCHAR(20) NOT NULL,

    CONSTRAINT pk_voluntario_id
        PRIMARY KEY (id),

    CONSTRAINT fk_voluntario_id
        FOREIGN KEY (id) REFERENCES Utilizador(id)
);

/* ----------------------- AREA DE INTERESSE ----------------------- */

CREATE TABLE Area_de_Interesse (
    area            VARCHAR(50),

    CONSTRAINT pk_area_de_interesse
        PRIMARY KEY (area)
);

CREATE TABLE Voluntario_Area (
    id_voluntario       NUMERIC(65),
    area                VARCHAR(30),

    CONSTRAINT pk_voluntario_area
        PRIMARY KEY (id_voluntario, area),

    CONSTRAINT fk_voluntario_area_voluntario
        FOREIGN KEY (id_voluntario) REFERENCES Voluntario(id),

    CONSTRAINT fk_voluntario_area_area
        FOREIGN KEY (area) REFERENCES Area_de_Interesse(area)
);

/* ----------------------- POPULACAO ALVO ----------------------- */

CREATE TABLE Populacao_Alvo (
    populacao       VARCHAR(50),

    CONSTRAINT pk_populacao_alvo
        PRIMARY KEY (populacao)
);

CREATE TABLE Voluntario_Populacao_Alvo (
    id_voluntario       NUMERIC(65),
    populacao_alvo      VARCHAR(30),

    CONSTRAINT pk_voluntario_populacao_alvo
        PRIMARY KEY (id_voluntario, populacao_alvo),

    CONSTRAINT fk_voluntario_populacao_alvo_voluntario
        FOREIGN KEY (id_voluntario) REFERENCES Voluntario(id),

    CONSTRAINT fk_voluntario_populacao_alvo_populacao
        FOREIGN KEY (populacao_alvo) REFERENCES Populacao_Alvo(populacao)
);

/* ----------------------- DISPONIBILIDADE ----------------------- */

CREATE TABLE Voluntario_Disponibilidade (
    id_voluntario       NUMERIC(65),
    dia                 VARCHAR(30),
    hora                NUMERIC(3),
    duracao             NUMERIC(3),

    CONSTRAINT pk_voluntario_disponibilidade
        PRIMARY KEY (id_voluntario, dia, hora, duracao),
    
    CONSTRAINT fk_voluntario_disponibilidade_voluntario
        FOREIGN KEY (id_voluntario) REFERENCES Voluntario(id)
);

/* ----------------------- ACAO ----------------------- */

CREATE TABLE Acao (
    id_instituicao      NUMERIC(65),
    id_acao             NUMERIC(65),
    distrito            VARCHAR(50) NOT NULL,
    concelho            VARCHAR(50) NOT NULL,
    freguesia           VARCHAR(50) NOT NULL,
    funcao              VARCHAR(50) NOT NULL,
    area_interesse      VARCHAR(50) NOT NULL,
    populacao_alvo      VARCHAR(50) NOT NULL,
    num_vagas           NUMERIC(5) NOT NULL,
    dia                 NUMERIC(3) NOT NULL,
    hora                NUMERIC(3) NOT NULL,
    semana              NUMERIC(3) NOT NULL,
    duracao             NUMERIC(3) NOT NULL,
    covid               VARCHAR(10) NOT NULL,

    CONSTRAINT pk_acao
        PRIMARY KEY (id_instituicao, id_acao),

    CONSTRAINT fk_acao_instituicao
        FOREIGN KEY (id_instituicao) REFERENCES Instituicao(id),

    CONSTRAINT fk_acao_area_interesse
        FOREIGN KEY (area_interesse) REFERENCES Area_de_Interesse(area),

    CONSTRAINT fk_acao_populacao_alvo
        FOREIGN KEY (populacao_alvo) REFERENCES Populacao_Alvo(populacao)
);


/* ----------------------- PARTICIPOU EM ACAO ----------------------- */

CREATE TABLE Participou_Acao (
    id_voluntario           NUMERIC(65),
    id_instituicao          NUMERIC(65),
    id_acao                 NUMERIC(65),

    CONSTRAINT pk_participou_acao
        PRIMARY KEY (id_voluntario, id_instituicao, id_acao),

    CONSTRAINT fk_participou_acao_voluntario
        FOREIGN KEY (id_voluntario) REFERENCES Voluntario(id),

    CONSTRAINT fk_participou_acao_acao
        FOREIGN KEY (id_instituicao, id_acao) REFERENCES Acao(id_instituicao, id_acao)
);

/* ----------------------- PUBLICACOES ----------------------- */

CREATE TABLE Publicacao (
    id                  NUMERIC (65),
    dono                NUMERIC(65) NOT NULL,
    imagem              VARBINARY (65535),
    descricao           VARCHAR (150),

    CONSTRAINT pk_publicacao
        PRIMARY KEY (id),
        
    CONSTRAINT fk_dono_publicacao
        FOREIGN KEY (dono) REFERENCES Utilizador(id)
);

CREATE TABLE Participa_em_Publicacao (
    id_publicacao      NUMERIC (65),
    participante       NUMERIC (65),
    
    CONSTRAINT pk_participa_em_publicacao
        PRIMARY KEY (id_publicacao, participante),
        
    CONSTRAINT fk_participa_publicacao 
        FOREIGN KEY (id_publicacao) REFERENCES Publicacao(id),

    CONSTRAINT fk_participa_participante
        FOREIGN KEY (participante) REFERENCES Utilizador(id)
);

/* ----------------------- MENSAGENS ----------------------- */

CREATE TABLE Mensagem (
    id                  NUMERIC (65),
    de                  NUMERIC (65) NOT NULL,
    para                NUMERIC (65) NOT NULL,
    texto               VARCHAR (1000) NOT NULL,
    hora                NUMERIC (3) NOT NULL,
    minuto              NUMERIC (3) NOT NULL,

    CONSTRAINT pk_mensagem
        PRIMARY KEY (id),
        
    CONSTRAINT fk_mensagem_de
        FOREIGN KEY (de) REFERENCES Utilizador(id),

    CONSTRAINT fk_mensagem_para
        FOREIGN KEY (para) REFERENCES Utilizador(id)
);