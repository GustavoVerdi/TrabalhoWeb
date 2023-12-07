--TABLE LOGIN
CREATE TABLE public.logins
(
    idlogin character varying(255),
    senha character varying(255),
	PRIMARY KEY(idlogin)
)
--INSERT LOGINS
INSERT INTO public.LOGINS (idlogin,senha) VALUES ('TRABALHOFINAL','123456');
INSERT INTO public.LOGINS (idlogin,senha) VALUES ('POSTGRES','123456');
INSERT INTO public.LOGINS (idlogin,senha) VALUES ('TESTE','TESTE')

SELECT * FROM LOGINS

--TABLE USUARIO
CREATE TABLE public.usuario
(
    codigo SERIAL PRIMARY KEY,
    nome character varying(255),
    sobrenome character varying(255),
    datenas date,
    email character varying(255)
)
--INSERT USUARIO
INSERT INTO public.usuario(nome, sobrenome, datenas, email) VALUES ('João', 'Silva', '1990-05-15', 'joao.silva@email.com');
INSERT INTO public.usuario(nome, sobrenome, datenas, email) VALUES ('Maria', 'Souza', '1985-08-22', 'maria.souza@email.com');
INSERT INTO public.usuario(nome, sobrenome, datenas, email) VALUES ('Pedro', 'Almeida', '2000-12-10', 'pedro.almeida@email.com');
INSERT INTO public.usuario(nome, sobrenome, datenas, email) VALUES ('Ana', 'Costa', '1988-03-25', 'ana.costa@email.com');
INSERT INTO public.usuario(nome, sobrenome, datenas, email) VALUES ('Carlos', 'Pereira', '1995-11-08', 'carlos.pereira@email.com');
INSERT INTO public.usuario(nome, sobrenome, datenas, email) VALUES ('Juliana', 'Rodrigues', '1980-07-18', 'juliana.rodrigues@email.com')