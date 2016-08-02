--
-- PostgreSQL database dump
--

-- Dumped from database version 9.4.4
-- Dumped by pg_dump version 9.5.1

-- Started on 2016-07-29 22:14:11

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 11855)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2329 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- TOC entry 233 (class 1255 OID 19109)
-- Name: agregaralumnogrupo(numeric, numeric); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION agregaralumnogrupo(grupo numeric, participante numeric) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
 respuesta integer := 0;
 estado integer := 0;
BEGIN
SELECT INTO respuesta COUNT(*) 
	FROM "GruposParticipantes" "T0" 
	WHERE "T0"."CodigoGrupoPeriodo" = grupo AND "T0"."CodigoParticipante" = participante;
IF respuesta > 0 THEN
	SELECT INTO estado "CodigoEstadosParticipacion"
	FROM "GruposParticipantes" "T0" 
	WHERE "T0"."CodigoGrupoPeriodo" = grupo AND "T0"."CodigoParticipante" = participante;
	IF estado = 1 THEN
		respuesta := 3;
		UPDATE "GruposParticipantes" SET "CodigoEstadosParticipacion" = 2
		WHERE "CodigoGrupoPeriodo" = grupo AND "CodigoParticipante" = participante;
	ELSE
		respuesta := 2;
		UPDATE "GruposParticipantes" SET "CodigoEstadosParticipacion" = 1
		WHERE "CodigoGrupoPeriodo" = grupo AND "CodigoParticipante" = participante;
	END IF;
 ELSE
	INSERT INTO "GruposParticipantes" ("CalificacionModulo","CodigoParticipante","CodigoEstadosParticipacion","CodigoUsuario","CodigoGrupoPeriodo") VALUES(0.0,participante,1,1,grupo);
	respuesta := 1;
END IF;
 RETURN respuesta;
END; $$;


ALTER FUNCTION public.agregaralumnogrupo(grupo numeric, participante numeric) OWNER TO postgres;

--
-- TOC entry 234 (class 1255 OID 19110)
-- Name: agregaralumnogrupo(numeric, numeric, numeric); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION agregaralumnogrupo(grupo numeric, participante numeric, usuario numeric) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
 respuesta integer := 0;
 estado integer := 0;
BEGIN
SELECT INTO respuesta COUNT(*) 
	FROM "GruposParticipantes" "T0" 
	WHERE "T0"."CodigoGrupoPeriodo" = grupo AND "T0"."CodigoParticipante" = participante;
IF respuesta > 0 THEN
	SELECT INTO estado "CodigoEstadosParticipacion"
	FROM "GruposParticipantes" "T0" 
	WHERE "T0"."CodigoGrupoPeriodo" = grupo AND "T0"."CodigoParticipante" = participante;
	IF estado = 1 THEN
		respuesta := 3;
		UPDATE "GruposParticipantes" SET "CodigoEstadosParticipacion" = 2, "CodigoUsuario" = usuario
		WHERE "CodigoGrupoPeriodo" = grupo AND "CodigoParticipante" = participante;
	ELSE
		respuesta := 2;
		UPDATE "GruposParticipantes" SET "CodigoEstadosParticipacion" = 1, "CodigoUsuario" = usuario
		WHERE "CodigoGrupoPeriodo" = grupo AND "CodigoParticipante" = participante;
	END IF;
 ELSE
	INSERT INTO "GruposParticipantes" ("CalificacionModulo","CodigoParticipante","CodigoEstadosParticipacion","CodigoUsuario","CodigoGrupoPeriodo") VALUES(0.0,participante,1,usuario,grupo);
	respuesta := 1;
END IF;
 RETURN respuesta;
END; $$;


ALTER FUNCTION public.agregaralumnogrupo(grupo numeric, participante numeric, usuario numeric) OWNER TO postgres;

--
-- TOC entry 239 (class 1255 OID 19517)
-- Name: agregardocentegrupo(numeric, numeric); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION agregardocentegrupo(grupo numeric, usuario numeric) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
respuesta integer := 0;
estado integer := 0;
BEGIN
SELECT INTO respuesta COUNT(*) 
FROM "GruposMaestros" "T0" 
WHERE "T0"."CodigoGrupoPeriodo" = grupo AND "T0"."CodigoUsuario" = usuario;
IF respuesta > 0 THEN
SELECT INTO estado "Estado"
FROM "GruposMaestros" "T0" 
WHERE "T0"."CodigoGrupoPeriodo" = grupo AND "T0"."CodigoUsuario" = usuario;
IF estado = 1 THEN
respuesta := 3;
UPDATE "GruposMaestros" SET "Estado" = 0
WHERE "CodigoGrupoPeriodo" = grupo AND "T0"."CodigoUsuario" = usuario;
ELSE
respuesta := 2;
UPDATE "GruposMaestros" SET "Estado" = 1
WHERE "CodigoGrupoPeriodo" = grupo AND "T0"."CodigoUsuario" = usuario;
END IF;
ELSE
INSERT INTO "GruposMaestros" ("CodigoUsuario","CodigoGrupoPeriodo","Estado") VALUES(usuario,grupo,1);
respuesta := 1;
END IF;
RETURN respuesta;
END; $$;


ALTER FUNCTION public.agregardocentegrupo(grupo numeric, usuario numeric) OWNER TO postgres;

--
-- TOC entry 235 (class 1255 OID 19111)
-- Name: getgruposactuales(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION getgruposactuales() RETURNS TABLE(codigogrupoperiodo integer, nombremodulo character varying, fechafinperiodo date, fechainicioperiodo date, aula character varying, horaentrada time without time zone, horasalida time without time zone)
    LANGUAGE plpgsql
    AS $$
BEGIN
 RETURN QUERY SELECT
 "T0"."CodigoGrupoPeriodo", 
  "T2"."NombreModulo",
  "T1"."FechaFinPeriodo", 
  "T1"."FechaInicioPeriodo",
  "T0"."Aula",
  "T0"."HoraEntrada",
  "T0"."HoraSalida"
FROM
  "GrupoPeriodos" "T0"
  INNER JOIN "Periodos" "T1" ON "T1"."CodigoPeriodo" = "T0"."CodigoPeriodo"
  INNER JOIN "Modulos" "T2" ON "T2"."CodigoModulo" = "T1"."CodigoModulo"
WHERE
  DATE_PART('year',"T1"."FechaInicioPeriodo") = DATE_PART('year',current_date);
END; $$;


ALTER FUNCTION public.getgruposactuales() OWNER TO postgres;

--
-- TOC entry 236 (class 1255 OID 19112)
-- Name: getgruposactuales(numeric); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION getgruposactuales(diplomado numeric) RETURNS TABLE(codigogrupoperiodo integer, nombremodulo character varying, fechafinperiodo date, fechainicioperiodo date, aula character varying, horaentrada time without time zone, horasalida time without time zone)
    LANGUAGE plpgsql
    AS $$
BEGIN
 RETURN QUERY SELECT
 "T0"."CodigoGrupoPeriodo", 
  "T2"."NombreModulo",
  "T1"."FechaFinPeriodo", 
  "T1"."FechaInicioPeriodo",
  "T0"."Aula",
  "T0"."HoraEntrada",
  "T0"."HoraSalida"
FROM
  "GrupoPeriodos" "T0"
  INNER JOIN "Periodos" "T1" ON "T1"."CodigoPeriodo" = "T0"."CodigoPeriodo"
  INNER JOIN "Modulos" "T2" ON "T2"."CodigoModulo" = "T1"."CodigoModulo"
WHERE
  "T2"."CodigoDiplomado" = diplomado AND
  DATE_PART('year',"T1"."FechaInicioPeriodo") = DATE_PART('year',current_date);
END; $$;


ALTER FUNCTION public.getgruposactuales(diplomado numeric) OWNER TO postgres;

--
-- TOC entry 237 (class 1255 OID 19113)
-- Name: getgruposactuales(numeric, numeric); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION getgruposactuales(diplomado numeric, participante numeric) RETURNS TABLE(codigogrupoperiodo integer, nombremodulo character varying, fechafinperiodo date, fechainicioperiodo date, horaentrada time without time zone, horasalida time without time zone, aula character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
 RETURN QUERY SELECT
 "T0"."CodigoGrupoPeriodo", 
  "T2"."NombreModulo",
  "T1"."FechaFinPeriodo", 
  "T1"."FechaInicioPeriodo",
  "T0"."HoraEntrada",
  "T0"."HoraSalida",
  "T0"."Aula",
  (SELECT COUNT(*) FROM "GruposParticipantes" "T3" WHERE "T3"."CodigoParticipante" = participante AND "T3"."CodigoGrupoPeriodo" = "T0"."CodigoGrupoPeriodo" ) AS "Inscrito"
FROM
  "GrupoPeriodos" "T0"
  INNER JOIN "Periodos" "T1" ON "T1"."CodigoPeriodo" = "T0"."CodigoPeriodo"
  INNER JOIN "Modulos" "T2" ON "T2"."CodigoModulo" = "T1"."CodigoModulo"
WHERE
  "T2"."CodigoDiplomado" = diplomado AND
  DATE_PART('year',"T1"."FechaInicioPeriodo") = DATE_PART('year',current_date);
END; $$;


ALTER FUNCTION public.getgruposactuales(diplomado numeric, participante numeric) OWNER TO postgres;

--
-- TOC entry 238 (class 1255 OID 19114)
-- Name: getgruposactualesbyalumno(numeric, numeric); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION getgruposactualesbyalumno(diplomado numeric, participante numeric) RETURNS TABLE(codigogrupoperiodo integer, nombremodulo character varying, fechafinperiodo date, fechainicioperiodo date, horaentrada time without time zone, horasalida time without time zone, aula character varying, inscrito integer)
    LANGUAGE plpgsql
    AS $$
BEGIN
 RETURN QUERY SELECT
 "T0"."CodigoGrupoPeriodo", 
  "T2"."NombreModulo",
  "T1"."FechaFinPeriodo", 
  "T1"."FechaInicioPeriodo",
  "T0"."HoraEntrada",
  "T0"."HoraSalida",
  "T0"."Aula",
  CASE WHEN ((SELECT COUNT(*) FROM "GruposParticipantes" "T3" WHERE "T3"."CodigoParticipante" = participante AND "T3"."CodigoGrupoPeriodo" = "T0"."CodigoGrupoPeriodo" ) = 0 )THEN
	0 ELSE (SELECT "T4"."CodigoEstadosParticipacion" FROM "GruposParticipantes" "T4" WHERE "T4"."CodigoGrupoPeriodo" = "T0"."CodigoGrupoPeriodo" AND "T4"."CodigoParticipante" = participante)
	END AS "Inscrito"
FROM
  "GrupoPeriodos" "T0"
  INNER JOIN "Periodos" "T1" ON "T1"."CodigoPeriodo" = "T0"."CodigoPeriodo"
  INNER JOIN "Modulos" "T2" ON "T2"."CodigoModulo" = "T1"."CodigoModulo"
WHERE
  "T2"."CodigoDiplomado" = diplomado AND
  DATE_PART('year',"T1"."FechaInicioPeriodo") = DATE_PART('year',current_date);
END; $$;


ALTER FUNCTION public.getgruposactualesbyalumno(diplomado numeric, participante numeric) OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 173 (class 1259 OID 19115)
-- Name: Archivos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Archivos" (
    "CodigoArchivos" integer NOT NULL,
    "Ruta" character varying NOT NULL,
    "Nombre" character varying(100) NOT NULL,
    "Extension" character varying(50) NOT NULL,
    "Estado" boolean,
    "UsuarioModifica" integer,
    "IpModifica" character varying(16),
    "FechaModifica" date,
    "CodigoUsuarios" integer,
    "CodigoPublicaciones" integer
);


ALTER TABLE "Archivos" OWNER TO postgres;

--
-- TOC entry 174 (class 1259 OID 19121)
-- Name: Archivos_CodigoArchivos_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Archivos_CodigoArchivos_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Archivos_CodigoArchivos_seq" OWNER TO postgres;

--
-- TOC entry 2330 (class 0 OID 0)
-- Dependencies: 174
-- Name: Archivos_CodigoArchivos_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Archivos_CodigoArchivos_seq" OWNED BY "Archivos"."CodigoArchivos";


--
-- TOC entry 175 (class 1259 OID 19123)
-- Name: Auditoria; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Auditoria" (
    "CodigoAuditoria" integer NOT NULL,
    "DatosAnteriores" character varying NOT NULL,
    "DatosPosteriores" character varying NOT NULL,
    "Usuario" integer NOT NULL,
    "IP" character varying NOT NULL,
    "Fecha" date NOT NULL,
    "TablaAfectada" character varying(150) NOT NULL
);


ALTER TABLE "Auditoria" OWNER TO postgres;

--
-- TOC entry 176 (class 1259 OID 19129)
-- Name: Auditoria_CodigoAuditoria_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Auditoria_CodigoAuditoria_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Auditoria_CodigoAuditoria_seq" OWNER TO postgres;

--
-- TOC entry 2331 (class 0 OID 0)
-- Dependencies: 176
-- Name: Auditoria_CodigoAuditoria_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Auditoria_CodigoAuditoria_seq" OWNED BY "Auditoria"."CodigoAuditoria";


--
-- TOC entry 177 (class 1259 OID 19131)
-- Name: CategoriaDiplomados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "CategoriaDiplomados" (
    "CodigoCategoriaDiplomado" integer NOT NULL,
    "NombreCategoriaDiplomado" character varying NOT NULL,
    "UsuarioModifica" integer,
    "IpModifica" character varying(16),
    "FechaModifica" date,
    "Estado" boolean,
    "Comentarios" character varying
);


ALTER TABLE "CategoriaDiplomados" OWNER TO postgres;

--
-- TOC entry 178 (class 1259 OID 19137)
-- Name: CategoriaDiplomados_CodigoCategoriaDiplomado_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "CategoriaDiplomados_CodigoCategoriaDiplomado_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "CategoriaDiplomados_CodigoCategoriaDiplomado_seq" OWNER TO postgres;

--
-- TOC entry 2332 (class 0 OID 0)
-- Dependencies: 178
-- Name: CategoriaDiplomados_CodigoCategoriaDiplomado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "CategoriaDiplomados_CodigoCategoriaDiplomado_seq" OWNED BY "CategoriaDiplomados"."CodigoCategoriaDiplomado";


--
-- TOC entry 179 (class 1259 OID 19139)
-- Name: CategoriasParticipante; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "CategoriasParticipante" (
    "CodigoCategoriaParticipantes" integer NOT NULL,
    "NombreCategoriaParticipante" character varying(200),
    "CuotaCategoriaParticipante" double precision,
    "Descripcion" character varying,
    "Comentarios" character varying
);


ALTER TABLE "CategoriasParticipante" OWNER TO postgres;

--
-- TOC entry 180 (class 1259 OID 19145)
-- Name: CategoriasParticipante_CodigoCategoriaParticipantes_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "CategoriasParticipante_CodigoCategoriaParticipantes_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "CategoriasParticipante_CodigoCategoriaParticipantes_seq" OWNER TO postgres;

--
-- TOC entry 2333 (class 0 OID 0)
-- Dependencies: 180
-- Name: CategoriasParticipante_CodigoCategoriaParticipantes_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "CategoriasParticipante_CodigoCategoriaParticipantes_seq" OWNED BY "CategoriasParticipante"."CodigoCategoriaParticipantes";


--
-- TOC entry 181 (class 1259 OID 19147)
-- Name: Comentarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Comentarios" (
    "CodigoComentarios" integer NOT NULL,
    "FechaComentario" date NOT NULL,
    "CorreoPublica" character varying(100),
    "Cuerpo" character varying NOT NULL,
    "NombrePublica" character varying(50) NOT NULL,
    "UsuarioModifica" integer NOT NULL,
    "IpModifica" character varying(16) NOT NULL,
    "FechaModifica" date NOT NULL,
    "Estado" boolean,
    "CodigoPublicaciones" integer
);


ALTER TABLE "Comentarios" OWNER TO postgres;

--
-- TOC entry 182 (class 1259 OID 19153)
-- Name: Comentarios_CodigoComentarios_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Comentarios_CodigoComentarios_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Comentarios_CodigoComentarios_seq" OWNER TO postgres;

--
-- TOC entry 2334 (class 0 OID 0)
-- Dependencies: 182
-- Name: Comentarios_CodigoComentarios_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Comentarios_CodigoComentarios_seq" OWNED BY "Comentarios"."CodigoComentarios";


--
-- TOC entry 183 (class 1259 OID 19155)
-- Name: Constantes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Constantes" (
    "CodigoConstante" integer NOT NULL,
    "NombreConstante" character varying NOT NULL,
    "ValorConstante" character varying NOT NULL,
    "Estado" boolean
);


ALTER TABLE "Constantes" OWNER TO postgres;

--
-- TOC entry 184 (class 1259 OID 19161)
-- Name: Constantes_CodigoConstante_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Constantes_CodigoConstante_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Constantes_CodigoConstante_seq" OWNER TO postgres;

--
-- TOC entry 2335 (class 0 OID 0)
-- Dependencies: 184
-- Name: Constantes_CodigoConstante_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Constantes_CodigoConstante_seq" OWNED BY "Constantes"."CodigoConstante";


--
-- TOC entry 185 (class 1259 OID 19163)
-- Name: Diplomados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Diplomados" (
    "CodigoDiplomado" integer NOT NULL,
    "NombreDiplomado" character varying NOT NULL,
    "Descripcion" character varying NOT NULL,
    "Estado" boolean,
    "CodigoCategoriaDiplomado" integer,
    "Comentarios" character varying,
    "UsuarioModifica" integer,
    "IpModifica" character varying,
    "FechaModifica" date
);


ALTER TABLE "Diplomados" OWNER TO postgres;

--
-- TOC entry 186 (class 1259 OID 19169)
-- Name: Diplomados_CodigoDiplomado_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Diplomados_CodigoDiplomado_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Diplomados_CodigoDiplomado_seq" OWNER TO postgres;

--
-- TOC entry 2336 (class 0 OID 0)
-- Dependencies: 186
-- Name: Diplomados_CodigoDiplomado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Diplomados_CodigoDiplomado_seq" OWNED BY "Diplomados"."CodigoDiplomado";


--
-- TOC entry 187 (class 1259 OID 19171)
-- Name: EstadosParticipantes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "EstadosParticipantes" (
    "CodigoEstados" integer NOT NULL,
    "NombreEstado" character varying(50) NOT NULL,
    "Estado" boolean NOT NULL,
    "UsuarioModifica" integer,
    "IPModifica" character varying,
    "FechaModifica" date
);


ALTER TABLE "EstadosParticipantes" OWNER TO postgres;

--
-- TOC entry 188 (class 1259 OID 19177)
-- Name: EstadosParticipantes_CodigoEstados_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "EstadosParticipantes_CodigoEstados_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "EstadosParticipantes_CodigoEstados_seq" OWNER TO postgres;

--
-- TOC entry 2337 (class 0 OID 0)
-- Dependencies: 188
-- Name: EstadosParticipantes_CodigoEstados_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "EstadosParticipantes_CodigoEstados_seq" OWNED BY "EstadosParticipantes"."CodigoEstados";


--
-- TOC entry 189 (class 1259 OID 19179)
-- Name: GrupoPeriodos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "GrupoPeriodos" (
    "CodigoGrupoPeriodo" integer NOT NULL,
    "CodigoPeriodo" integer,
    "Estado" boolean,
    "HoraEntrada" time without time zone NOT NULL,
    "HoraSalida" time without time zone NOT NULL,
    "Aula" character varying(10)
);


ALTER TABLE "GrupoPeriodos" OWNER TO postgres;

--
-- TOC entry 190 (class 1259 OID 19182)
-- Name: GrupoPeriodos_CodigoGrupoPeriodo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "GrupoPeriodos_CodigoGrupoPeriodo_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "GrupoPeriodos_CodigoGrupoPeriodo_seq" OWNER TO postgres;

--
-- TOC entry 2338 (class 0 OID 0)
-- Dependencies: 190
-- Name: GrupoPeriodos_CodigoGrupoPeriodo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "GrupoPeriodos_CodigoGrupoPeriodo_seq" OWNED BY "GrupoPeriodos"."CodigoGrupoPeriodo";


--
-- TOC entry 191 (class 1259 OID 19184)
-- Name: GruposMaestros; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "GruposMaestros" (
    "CodigoGruposPeriodoUsuario" integer NOT NULL,
    "CodigoUsuario" integer,
    "CodigoGrupoPeriodo" integer,
    "Estado" integer DEFAULT 0 NOT NULL
);


ALTER TABLE "GruposMaestros" OWNER TO postgres;

--
-- TOC entry 192 (class 1259 OID 19187)
-- Name: GruposParticipantes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "GruposParticipantes" (
    "CodigoGruposParticipantes" integer NOT NULL,
    "CalificacionModulo" double precision,
    "CodigoParticipante" integer,
    "CodigoEstadosParticipacion" integer,
    "CodigoUsuario" integer,
    "CodigoGrupoPeriodo" integer
);


ALTER TABLE "GruposParticipantes" OWNER TO postgres;

--
-- TOC entry 193 (class 1259 OID 19190)
-- Name: GruposParticipantes_CodigoGruposParticipantes_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "GruposParticipantes_CodigoGruposParticipantes_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "GruposParticipantes_CodigoGruposParticipantes_seq" OWNER TO postgres;

--
-- TOC entry 2339 (class 0 OID 0)
-- Dependencies: 193
-- Name: GruposParticipantes_CodigoGruposParticipantes_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "GruposParticipantes_CodigoGruposParticipantes_seq" OWNED BY "GruposParticipantes"."CodigoGruposParticipantes";


--
-- TOC entry 194 (class 1259 OID 19192)
-- Name: GruposPeriodoUsuarios_CodigoGruposPeriodoUsuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "GruposPeriodoUsuarios_CodigoGruposPeriodoUsuario_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "GruposPeriodoUsuarios_CodigoGruposPeriodoUsuario_seq" OWNER TO postgres;

--
-- TOC entry 2340 (class 0 OID 0)
-- Dependencies: 194
-- Name: GruposPeriodoUsuarios_CodigoGruposPeriodoUsuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "GruposPeriodoUsuarios_CodigoGruposPeriodoUsuario_seq" OWNED BY "GruposMaestros"."CodigoGruposPeriodoUsuario";


--
-- TOC entry 195 (class 1259 OID 19194)
-- Name: Modulos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Modulos" (
    "CodigoModulo" integer NOT NULL,
    "NombreModulo" character varying NOT NULL,
    "OrdenModulo" character varying NOT NULL,
    "Estado" boolean,
    "UsuarioModifica" integer,
    "IpModifica" character varying,
    "FechaModifica" date,
    "CodigoTurno" integer NOT NULL,
    "CodigoDiplomado" integer NOT NULL,
    "Comentarios" character varying
);


ALTER TABLE "Modulos" OWNER TO postgres;

--
-- TOC entry 196 (class 1259 OID 19200)
-- Name: Modulos_CodigoModulo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Modulos_CodigoModulo_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Modulos_CodigoModulo_seq" OWNER TO postgres;

--
-- TOC entry 2341 (class 0 OID 0)
-- Dependencies: 196
-- Name: Modulos_CodigoModulo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Modulos_CodigoModulo_seq" OWNED BY "Modulos"."CodigoModulo";


--
-- TOC entry 197 (class 1259 OID 19202)
-- Name: Participantes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Participantes" (
    "CodigoParticipante" integer NOT NULL,
    "CorreoElectronico" character varying(100),
    "TelefonoFijo" character varying(9),
    "TelefonoCelular" character varying(9),
    "Direccion" character varying(200),
    "NumeroDUI" character varying(10),
    "Nombre" character varying(100) NOT NULL,
    "FechaNacimiento" date NOT NULL,
    "CodigoUniversidadProcedencia" integer,
    "Carrera" character varying(100),
    "NivelAcademico" character varying(100),
    "NombreEncargado" character varying(150),
    "Descripcion" character varying,
    "UsuarioModifica" integer,
    "IPModifica" character varying,
    "FechaModifica" date,
    "CodigoCategoriaParticipantes" integer NOT NULL,
    "Comentarios" character varying,
    "Genero" character varying(10),
    "CarnetAlumno" character varying(12)
);


ALTER TABLE "Participantes" OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 19208)
-- Name: Participantes_CodigoParticipante_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Participantes_CodigoParticipante_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Participantes_CodigoParticipante_seq" OWNER TO postgres;

--
-- TOC entry 2342 (class 0 OID 0)
-- Dependencies: 198
-- Name: Participantes_CodigoParticipante_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Participantes_CodigoParticipante_seq" OWNED BY "Participantes"."CodigoParticipante";


--
-- TOC entry 199 (class 1259 OID 19210)
-- Name: Periodos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Periodos" (
    "CodigoPeriodo" integer NOT NULL,
    "FechaInicioPeriodo" date,
    "FechaFinPeriodo" date,
    "Estado" boolean,
    "Comentario" character varying,
    "CodigoModulo" integer NOT NULL
);


ALTER TABLE "Periodos" OWNER TO postgres;

--
-- TOC entry 200 (class 1259 OID 19216)
-- Name: Periodos_CodigoPeriodo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Periodos_CodigoPeriodo_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Periodos_CodigoPeriodo_seq" OWNER TO postgres;

--
-- TOC entry 2343 (class 0 OID 0)
-- Dependencies: 200
-- Name: Periodos_CodigoPeriodo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Periodos_CodigoPeriodo_seq" OWNED BY "Periodos"."CodigoPeriodo";


--
-- TOC entry 201 (class 1259 OID 19218)
-- Name: Permisos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Permisos" (
    "CodigoPermisos" integer NOT NULL,
    "NombrePermiso" character varying(50) NOT NULL,
    "EstadoPermisos" boolean,
    "UsuarioModifica" integer NOT NULL,
    "IpModifica" character varying(16) NOT NULL,
    "FechaModifica" date NOT NULL,
    "idContainer" character varying(500),
    "classContainer" character varying(500),
    "controllerContainer" character varying(500),
    "systemPart" character varying(500),
    "CodigoPermisoPadre" integer
);


ALTER TABLE "Permisos" OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 19224)
-- Name: PermisosEventos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "PermisosEventos" (
    "CodigoPermisosEventos" integer NOT NULL,
    "NombreEvento" character varying(100),
    "CodigoPermiso" integer,
    "TextoEvento" character varying
);


ALTER TABLE "PermisosEventos" OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 19230)
-- Name: PermisosEventos_CodigoPermisosEventos_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "PermisosEventos_CodigoPermisosEventos_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "PermisosEventos_CodigoPermisosEventos_seq" OWNER TO postgres;

--
-- TOC entry 2344 (class 0 OID 0)
-- Dependencies: 203
-- Name: PermisosEventos_CodigoPermisosEventos_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "PermisosEventos_CodigoPermisosEventos_seq" OWNED BY "PermisosEventos"."CodigoPermisosEventos";


--
-- TOC entry 204 (class 1259 OID 19232)
-- Name: Permisos_CodigoPermisos_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Permisos_CodigoPermisos_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Permisos_CodigoPermisos_seq" OWNER TO postgres;

--
-- TOC entry 2345 (class 0 OID 0)
-- Dependencies: 204
-- Name: Permisos_CodigoPermisos_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Permisos_CodigoPermisos_seq" OWNED BY "Permisos"."CodigoPermisos";


--
-- TOC entry 205 (class 1259 OID 19234)
-- Name: Publicaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Publicaciones" (
    "CodigoPublicacion" integer NOT NULL,
    "UsuarioPublica" integer,
    "FechaPublicacion" character varying,
    "Titulo" character varying(300),
    "Contenido" character varying,
    "ParticipantePublica" integer,
    "Estado" boolean,
    "CodigoGrupoPeriodo" integer,
    "CodigoGrupoParticipantes" integer,
    "CodigoGrupoPeriodoUsuario" integer,
    "CodigoTipoPublicacion" integer,
    "CodigoCategoriaDiplomado" integer
);


ALTER TABLE "Publicaciones" OWNER TO postgres;

--
-- TOC entry 2346 (class 0 OID 0)
-- Dependencies: 205
-- Name: COLUMN "Publicaciones"."CodigoTipoPublicacion"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN "Publicaciones"."CodigoTipoPublicacion" IS 'Este campo contiene la llave foranea a la tabla Tipo de publicacion ';


--
-- TOC entry 206 (class 1259 OID 19240)
-- Name: Publicaciones_CodigoPublicacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Publicaciones_CodigoPublicacion_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Publicaciones_CodigoPublicacion_seq" OWNER TO postgres;

--
-- TOC entry 2347 (class 0 OID 0)
-- Dependencies: 206
-- Name: Publicaciones_CodigoPublicacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Publicaciones_CodigoPublicacion_seq" OWNED BY "Publicaciones"."CodigoPublicacion";


--
-- TOC entry 207 (class 1259 OID 19242)
-- Name: Rol; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Rol" (
    "CodigoRol" integer NOT NULL,
    "NombreRol" character varying(150),
    "Estado" boolean NOT NULL,
    "VersionRol" character varying,
    "UsuarioModifica" integer,
    "IPModifica" character varying,
    "FechaModifica" date
);


ALTER TABLE "Rol" OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 19248)
-- Name: Rol_CodigoRol_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Rol_CodigoRol_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Rol_CodigoRol_seq" OWNER TO postgres;

--
-- TOC entry 2348 (class 0 OID 0)
-- Dependencies: 208
-- Name: Rol_CodigoRol_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Rol_CodigoRol_seq" OWNED BY "Rol"."CodigoRol";


--
-- TOC entry 209 (class 1259 OID 19250)
-- Name: RolesPermisos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "RolesPermisos" (
    "CodigoRolesPermisos" integer NOT NULL,
    "Estado" boolean,
    "CodigoPermisos" integer,
    "CodigoRol" integer
);


ALTER TABLE "RolesPermisos" OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 19253)
-- Name: RolesPermisos_CodigoRolesPermisos_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "RolesPermisos_CodigoRolesPermisos_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "RolesPermisos_CodigoRolesPermisos_seq" OWNER TO postgres;

--
-- TOC entry 2349 (class 0 OID 0)
-- Dependencies: 210
-- Name: RolesPermisos_CodigoRolesPermisos_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "RolesPermisos_CodigoRolesPermisos_seq" OWNED BY "RolesPermisos"."CodigoRolesPermisos";


--
-- TOC entry 211 (class 1259 OID 19255)
-- Name: Tema; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Tema" (
    "idTema" integer NOT NULL,
    "Nombre" character varying(50) NOT NULL,
    path character varying NOT NULL
);


ALTER TABLE "Tema" OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 19261)
-- Name: Tema_idTema_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Tema_idTema_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Tema_idTema_seq" OWNER TO postgres;

--
-- TOC entry 2350 (class 0 OID 0)
-- Dependencies: 212
-- Name: Tema_idTema_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Tema_idTema_seq" OWNED BY "Tema"."idTema";


--
-- TOC entry 213 (class 1259 OID 19263)
-- Name: TiposPublicacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "TiposPublicacion" (
    "CodigoTiposPublicacion" integer NOT NULL,
    "NombrePublicacion" character varying(100)
);


ALTER TABLE "TiposPublicacion" OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 19266)
-- Name: TiposPublicacion_CodigoTiposPublicacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "TiposPublicacion_CodigoTiposPublicacion_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "TiposPublicacion_CodigoTiposPublicacion_seq" OWNER TO postgres;

--
-- TOC entry 2351 (class 0 OID 0)
-- Dependencies: 214
-- Name: TiposPublicacion_CodigoTiposPublicacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "TiposPublicacion_CodigoTiposPublicacion_seq" OWNED BY "TiposPublicacion"."CodigoTiposPublicacion";


--
-- TOC entry 215 (class 1259 OID 19268)
-- Name: Turnos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Turnos" (
    "CodigoTurno" integer NOT NULL,
    "NombreTurno" character varying NOT NULL,
    "HoraInicio" time with time zone NOT NULL,
    "HoraFin" time with time zone NOT NULL,
    "UsuarioModifica" integer,
    "IpModifica" character varying(16),
    "FechaModifica" date,
    "Estado" boolean,
    "Comentarios" character varying
);


ALTER TABLE "Turnos" OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 19274)
-- Name: Turnos_CodigoTurno_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Turnos_CodigoTurno_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Turnos_CodigoTurno_seq" OWNER TO postgres;

--
-- TOC entry 2352 (class 0 OID 0)
-- Dependencies: 216
-- Name: Turnos_CodigoTurno_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Turnos_CodigoTurno_seq" OWNED BY "Turnos"."CodigoTurno";


--
-- TOC entry 217 (class 1259 OID 19276)
-- Name: UsuarioRoles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "UsuarioRoles" (
    "CodigoUsuarioRoles" integer NOT NULL,
    "CodigoRol" integer NOT NULL,
    "CodigoUsuario" integer NOT NULL
);


ALTER TABLE "UsuarioRoles" OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 19279)
-- Name: UsuarioRoles_CodigoUsuarioRoles_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "UsuarioRoles_CodigoUsuarioRoles_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "UsuarioRoles_CodigoUsuarioRoles_seq" OWNER TO postgres;

--
-- TOC entry 2353 (class 0 OID 0)
-- Dependencies: 218
-- Name: UsuarioRoles_CodigoUsuarioRoles_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "UsuarioRoles_CodigoUsuarioRoles_seq" OWNED BY "UsuarioRoles"."CodigoUsuarioRoles";


--
-- TOC entry 219 (class 1259 OID 19281)
-- Name: Usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Usuarios" (
    "CodigoUsuario" integer NOT NULL,
    "NombreUsuario" character varying(150) NOT NULL,
    "ContraseniaUsuario" character varying(50) NOT NULL,
    "CorreoUsuario" character varying(150) NOT NULL,
    "Nombre" character(200) NOT NULL,
    "UsuarioModifica" integer,
    "IPModifica" character varying,
    "FechaModifica" date,
    "Comentarios" character varying,
    "idTema" integer DEFAULT 1 NOT NULL
);


ALTER TABLE "Usuarios" OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 19288)
-- Name: Usuarios_CodigoUsuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Usuarios_CodigoUsuario_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Usuarios_CodigoUsuario_seq" OWNER TO postgres;

--
-- TOC entry 2354 (class 0 OID 0)
-- Dependencies: 220
-- Name: Usuarios_CodigoUsuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Usuarios_CodigoUsuario_seq" OWNED BY "Usuarios"."CodigoUsuario";


--
-- TOC entry 2044 (class 2604 OID 19290)
-- Name: CodigoArchivos; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Archivos" ALTER COLUMN "CodigoArchivos" SET DEFAULT nextval('"Archivos_CodigoArchivos_seq"'::regclass);


--
-- TOC entry 2045 (class 2604 OID 19291)
-- Name: CodigoAuditoria; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Auditoria" ALTER COLUMN "CodigoAuditoria" SET DEFAULT nextval('"Auditoria_CodigoAuditoria_seq"'::regclass);


--
-- TOC entry 2046 (class 2604 OID 19292)
-- Name: CodigoCategoriaDiplomado; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "CategoriaDiplomados" ALTER COLUMN "CodigoCategoriaDiplomado" SET DEFAULT nextval('"CategoriaDiplomados_CodigoCategoriaDiplomado_seq"'::regclass);


--
-- TOC entry 2047 (class 2604 OID 19293)
-- Name: CodigoCategoriaParticipantes; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "CategoriasParticipante" ALTER COLUMN "CodigoCategoriaParticipantes" SET DEFAULT nextval('"CategoriasParticipante_CodigoCategoriaParticipantes_seq"'::regclass);


--
-- TOC entry 2048 (class 2604 OID 19294)
-- Name: CodigoComentarios; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Comentarios" ALTER COLUMN "CodigoComentarios" SET DEFAULT nextval('"Comentarios_CodigoComentarios_seq"'::regclass);


--
-- TOC entry 2049 (class 2604 OID 19295)
-- Name: CodigoConstante; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Constantes" ALTER COLUMN "CodigoConstante" SET DEFAULT nextval('"Constantes_CodigoConstante_seq"'::regclass);


--
-- TOC entry 2050 (class 2604 OID 19296)
-- Name: CodigoDiplomado; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Diplomados" ALTER COLUMN "CodigoDiplomado" SET DEFAULT nextval('"Diplomados_CodigoDiplomado_seq"'::regclass);


--
-- TOC entry 2051 (class 2604 OID 19297)
-- Name: CodigoEstados; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "EstadosParticipantes" ALTER COLUMN "CodigoEstados" SET DEFAULT nextval('"EstadosParticipantes_CodigoEstados_seq"'::regclass);


--
-- TOC entry 2052 (class 2604 OID 19298)
-- Name: CodigoGrupoPeriodo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "GrupoPeriodos" ALTER COLUMN "CodigoGrupoPeriodo" SET DEFAULT nextval('"GrupoPeriodos_CodigoGrupoPeriodo_seq"'::regclass);


--
-- TOC entry 2053 (class 2604 OID 19299)
-- Name: CodigoGruposPeriodoUsuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "GruposMaestros" ALTER COLUMN "CodigoGruposPeriodoUsuario" SET DEFAULT nextval('"GruposPeriodoUsuarios_CodigoGruposPeriodoUsuario_seq"'::regclass);


--
-- TOC entry 2055 (class 2604 OID 19300)
-- Name: CodigoGruposParticipantes; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "GruposParticipantes" ALTER COLUMN "CodigoGruposParticipantes" SET DEFAULT nextval('"GruposParticipantes_CodigoGruposParticipantes_seq"'::regclass);


--
-- TOC entry 2056 (class 2604 OID 19301)
-- Name: CodigoModulo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Modulos" ALTER COLUMN "CodigoModulo" SET DEFAULT nextval('"Modulos_CodigoModulo_seq"'::regclass);


--
-- TOC entry 2057 (class 2604 OID 19302)
-- Name: CodigoParticipante; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Participantes" ALTER COLUMN "CodigoParticipante" SET DEFAULT nextval('"Participantes_CodigoParticipante_seq"'::regclass);


--
-- TOC entry 2058 (class 2604 OID 19303)
-- Name: CodigoPeriodo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Periodos" ALTER COLUMN "CodigoPeriodo" SET DEFAULT nextval('"Periodos_CodigoPeriodo_seq"'::regclass);


--
-- TOC entry 2059 (class 2604 OID 19304)
-- Name: CodigoPermisos; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Permisos" ALTER COLUMN "CodigoPermisos" SET DEFAULT nextval('"Permisos_CodigoPermisos_seq"'::regclass);


--
-- TOC entry 2060 (class 2604 OID 19305)
-- Name: CodigoPermisosEventos; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "PermisosEventos" ALTER COLUMN "CodigoPermisosEventos" SET DEFAULT nextval('"PermisosEventos_CodigoPermisosEventos_seq"'::regclass);


--
-- TOC entry 2061 (class 2604 OID 19306)
-- Name: CodigoPublicacion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Publicaciones" ALTER COLUMN "CodigoPublicacion" SET DEFAULT nextval('"Publicaciones_CodigoPublicacion_seq"'::regclass);


--
-- TOC entry 2062 (class 2604 OID 19307)
-- Name: CodigoRol; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Rol" ALTER COLUMN "CodigoRol" SET DEFAULT nextval('"Rol_CodigoRol_seq"'::regclass);


--
-- TOC entry 2063 (class 2604 OID 19308)
-- Name: CodigoRolesPermisos; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "RolesPermisos" ALTER COLUMN "CodigoRolesPermisos" SET DEFAULT nextval('"RolesPermisos_CodigoRolesPermisos_seq"'::regclass);


--
-- TOC entry 2064 (class 2604 OID 19309)
-- Name: idTema; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Tema" ALTER COLUMN "idTema" SET DEFAULT nextval('"Tema_idTema_seq"'::regclass);


--
-- TOC entry 2065 (class 2604 OID 19310)
-- Name: CodigoTiposPublicacion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "TiposPublicacion" ALTER COLUMN "CodigoTiposPublicacion" SET DEFAULT nextval('"TiposPublicacion_CodigoTiposPublicacion_seq"'::regclass);


--
-- TOC entry 2066 (class 2604 OID 19311)
-- Name: CodigoTurno; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Turnos" ALTER COLUMN "CodigoTurno" SET DEFAULT nextval('"Turnos_CodigoTurno_seq"'::regclass);


--
-- TOC entry 2067 (class 2604 OID 19312)
-- Name: CodigoUsuarioRoles; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "UsuarioRoles" ALTER COLUMN "CodigoUsuarioRoles" SET DEFAULT nextval('"UsuarioRoles_CodigoUsuarioRoles_seq"'::regclass);


--
-- TOC entry 2069 (class 2604 OID 19313)
-- Name: CodigoUsuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Usuarios" ALTER COLUMN "CodigoUsuario" SET DEFAULT nextval('"Usuarios_CodigoUsuario_seq"'::regclass);


--
-- TOC entry 2274 (class 0 OID 19115)
-- Dependencies: 173
-- Data for Name: Archivos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Archivos" ("CodigoArchivos", "Ruta", "Nombre", "Extension", "Estado", "UsuarioModifica", "IpModifica", "FechaModifica", "CodigoUsuarios", "CodigoPublicaciones") FROM stdin;
5	/images/publicaciones/AFICHE DIPLOMADOS OCT NOV 2011.JPG	AFICHE DIPLOMADOS OCT NOV 2011.JPG	JPG	t	1	::1	2016-05-01	1	4
6	/images/publicaciones/afiche-copas.jpg	afiche-copas.jpg	jpg	t	1	::1	2016-05-01	1	5
7	/images/publicaciones/afiche-Seminario-ITA.jpg	afiche-Seminario-ITA.jpg	jpg	t	1	::1	2016-05-01	1	6
8	/images/publicaciones/ALDEA-URBANA-1.jpg	ALDEA-URBANA-1.jpg	jpg	t	1	::1	2016-05-01	1	7
9	/images/publicaciones/Arte-afiche.jpg	Arte-afiche.jpg	jpg	t	1	::1	2016-05-01	1	8
18	/images/publicaciones/13158349-dibujo-de-un-nino-comiendo-en-una-mesa.jpg	13158349-dibujo-de-un-nino-comiendo-en-una-mesa.jpg	jpg	t	1	::1	2016-05-22	1	18
19	/images/publicaciones/33673762-la-ropa-del-bebe-que-cuelgan-en-el-tendedero.jpg	33673762-la-ropa-del-bebe-que-cuelgan-en-el-tendedero.jpg	jpg	t	1	::1	2016-05-22	1	19
20	/images/publicaciones/domosagua5.jpg	domosagua5.jpg	jpg	t	1	::1	2016-05-22	1	20
\.


--
-- TOC entry 2355 (class 0 OID 0)
-- Dependencies: 174
-- Name: Archivos_CodigoArchivos_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Archivos_CodigoArchivos_seq"', 20, true);


--
-- TOC entry 2276 (class 0 OID 19123)
-- Dependencies: 175
-- Data for Name: Auditoria; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Auditoria" ("CodigoAuditoria", "DatosAnteriores", "DatosPosteriores", "Usuario", "IP", "Fecha", "TablaAfectada") FROM stdin;
\.


--
-- TOC entry 2356 (class 0 OID 0)
-- Dependencies: 176
-- Name: Auditoria_CodigoAuditoria_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Auditoria_CodigoAuditoria_seq"', 1, false);


--
-- TOC entry 2278 (class 0 OID 19131)
-- Dependencies: 177
-- Data for Name: CategoriaDiplomados; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "CategoriaDiplomados" ("CodigoCategoriaDiplomado", "NombreCategoriaDiplomado", "UsuarioModifica", "IpModifica", "FechaModifica", "Estado", "Comentarios") FROM stdin;
4	Idiomas	1	0::0	2016-01-01	t	esto es una prueba
3	Ingenieria Electrica	346645	192.168.2.5	2014-05-12	t	Pertenece al departamento de ingenieria
2	Ingenieria En Sistemas	3453	192.168.1.4	2016-02-12	t	Pertenece l departamento de ingenieria
1	Ingenieria Industrial	1234	192.168.1.4	0216-02-12	t	Pertenece  al departamento de ing
5	Administracion	1	0::0	2016-06-02	t	Temas administrativos
7	Ciencias qumicas	1	0::0	2016-06-02	t	temas relacionados con e instituto publico
6	Medicina	1	0::0	2016-06-02	t	temas enfocados a estudiantes o profesionales de la salud.
8	Ingenieria Civil	1	0::0	2016-06-02	t	temas de ingenieria civil
9	Arquitectura	1	0::0	2016-06-02	t	temas relacionados a arquitectura.
10	Psicologia	1	0::0	2016-02-01	t	temas relacionados con psicologia.
11	Estadistica	1	0::00	2016-02-01	t	Temas relacionados a estadistica.
12	Informatica	1	0::0	2016-02-01	t	Generalidades de informatica.
13	Ciencias Fiisicas	1	0::0	2016-02-01	t	Temas relacionados a fisica
14	Vulcanologia	1	0::0	2016-02-01	t	Temas relacionados a vulcanologia.
15	Ciencias Juridicas	1	0::0	2016-02-01	t	Derecho
\.


--
-- TOC entry 2357 (class 0 OID 0)
-- Dependencies: 178
-- Name: CategoriaDiplomados_CodigoCategoriaDiplomado_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"CategoriaDiplomados_CodigoCategoriaDiplomado_seq"', 15, true);


--
-- TOC entry 2280 (class 0 OID 19139)
-- Dependencies: 179
-- Data for Name: CategoriasParticipante; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "CategoriasParticipante" ("CodigoCategoriaParticipantes", "NombreCategoriaParticipante", "CuotaCategoriaParticipante", "Descripcion", "Comentarios") FROM stdin;
1	Alumnos UES	25	Para alumnos	Categoria de prueba
2	HDT	17.5	Hijos de trabajadores de la UESFMOcc	Categoria creada para los hijos de trabajadores ues que pagaran menos como un beneficio para los empleados
3	Particular	30	Personas Particulares	No asociados directamente con la ues.
4	Becario	23.75	Alumnos Becados	Alumnos que cuentan con una Beca.
5	Exonerados	0	Personas con beca de tipo completa.	Participantes que no necesitan pago de mensualidad o cuota.
\.


--
-- TOC entry 2358 (class 0 OID 0)
-- Dependencies: 180
-- Name: CategoriasParticipante_CodigoCategoriaParticipantes_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"CategoriasParticipante_CodigoCategoriaParticipantes_seq"', 5, true);


--
-- TOC entry 2282 (class 0 OID 19147)
-- Dependencies: 181
-- Data for Name: Comentarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Comentarios" ("CodigoComentarios", "FechaComentario", "CorreoPublica", "Cuerpo", "NombrePublica", "UsuarioModifica", "IpModifica", "FechaModifica", "Estado", "CodigoPublicaciones") FROM stdin;
\.


--
-- TOC entry 2359 (class 0 OID 0)
-- Dependencies: 182
-- Name: Comentarios_CodigoComentarios_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Comentarios_CodigoComentarios_seq"', 1, false);


--
-- TOC entry 2284 (class 0 OID 19155)
-- Dependencies: 183
-- Data for Name: Constantes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Constantes" ("CodigoConstante", "NombreConstante", "ValorConstante", "Estado") FROM stdin;
\.


--
-- TOC entry 2360 (class 0 OID 0)
-- Dependencies: 184
-- Name: Constantes_CodigoConstante_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Constantes_CodigoConstante_seq"', 1, false);


--
-- TOC entry 2286 (class 0 OID 19163)
-- Dependencies: 185
-- Data for Name: Diplomados; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Diplomados" ("CodigoDiplomado", "NombreDiplomado", "Descripcion", "Estado", "CodigoCategoriaDiplomado", "Comentarios", "UsuarioModifica", "IpModifica", "FechaModifica") FROM stdin;
101	M101N: MongoDB for .Net Dev	Diplomado enfocado a desarrolladores en la plataforma .net de windows	t	2	Replica de Mongo University	\N	\N	\N
102	M102: MongoDB for DBAs	Enfocado a administradores de sistemas en donde el uso de mongoDB es primordial	t	2	Replica de Mongo University	\N	\N	\N
103	M101JS: MongoDB for NodeJs Dev	Enfocado a desarrolladores Node	t	2	Replica de Mongo University	\N	\N	\N
106	MO101: Herramientas MS Office enfocadas a Planeacion	Uso avanzado de Herramientas de ofimatica para planeacion efectiva	t	1	\N	\N	\N	\N
107	La inteligencia Cultural y la Administración de empresas internacionales	En los negocios internacionales es crucial que el líder de la empresa y sus diferentes equipos de trabajo tengan la capacidad de adaptarse a las diferencias culturales existentes entre país y país. 	t	1	TEST	2	::1	2016-07-02
109	La inteligencia Cultural y la Administración de empresas internacionales	En los negocios internacionales es crucial que el líder de la empresa y sus diferentes equipos de trabajo tengan la capacidad de adaptarse a las diferencias culturales existentes entre país y país. \n	f	5	test	2	::1	2016-07-02
108	La inteligencia Cultural y la Administración de empresas internacionales	En los negocios internacionales es crucial que el líder de la empresa y sus diferentes equipos de trabajo tengan la capacidad de adaptarse a las diferencias culturales existentes entre país y país. 	f	5	test	2	::1	2016-07-02
110	Software libre: Ofimática con OpenOffice	Durante el curso se darán a conocer los conceptos claves del Software y la Cultura Libre, y la filosofía e historia que hay tras ellos. También se darán unas nociones sobre distintas herramientas libres alternativas.\r\n	t	12	\N	\N	\N	\N
111	Estudio y aprovechamiento del agua en Islas y Terrenos Volcánicos	La islas volcánicas tienen una geología singular que condiciona enormemente la forma de aprovechar los recursos hídricos, que en general, es más compleja que en los territorios continentales. El agua en las islas volcánicas es un activo fundamental para el desarrollo económico y vital de sus habitantes.	t	14	\N	\N	\N	\N
112	El Régimen Jurídico de la Prevención de Riesgos Laborales	Con este curso se pretende que los estudiantes conozcan El marco jurídico de la prevención de riesgos laborales, partiendo del conocimiento de los conceptos jurídicos básicos que integran nuestro sistema de seguridad y salud en el trabajo.	t	15	\N	\N	\N	\N
113	Introducción al Quirófano	Conoce con detalle las técnicas y métodos que caracterizan a una correcta técnica quirúrgica y los aplica en la rutina del equipo quirúrgico durante la intervención para garantizar la seguridad del paciente y la efectividad de la técnica aséptica en un ambiente de ética y humanismo.	t	6	\N	\N	\N	\N
114	Gestión Estratégica de la Innovacion y el Emprendimiento	La gestión de la innovación corporativa tiene un impacto significativo en la competitividad de las empresas por el impacto en la productividad y en la expansión a nuevos mercados. 	t	5	\N	\N	\N	\N
115	Introducción al Diseño Paramétrico en Arquitectura	Este curso introducirá al alumno al uso de herramientas de modelado algorítmico y programación visual para la generación de forma. El diseño paramétrico se ha posicionado como una técnica muy poderosa para la optimización del diseño y el lenguaje arquitectónico. 	t	9	\N	\N	\N	\N
116	Farmacología Básica	Se trata de un curso que pretende aportar unos conocimientos elementales de lo que es la farmacología…El curso dará respuesta a preguntas como: ¿Qué diferencia hay entre fármaco o principio activo y medicamento?, ¿qué es una especilidad farmacéutica?, ¿qué son los medicamentos genéricos?	t	7	\N	\N	\N	\N
117	Parasitología humana	En esta asignatura se estudiarán los organismos parásitos que afectan a los seres humanos y los vectores que los transmiten. En primer lugar, se presentarán al estudiante los términos necesarios para poder desarrollar la disciplina, tales como la noción de parasitismo, tipos de parásitos y sus ciclos vitales, adaptación a la vida parasitaria, etc. 	t	6	\N	\N	\N	\N
118	Agilidad y Lean. Gestionando los proyectos y negocios del s. XXI 	Los objetivos del curso son conocer qué es la agilidad y el Lean aplicado a la tecnología. Profundizar en las técnicas ágiles que necesitará para gestionar con éxito el día a día de los proyectos software y tecnológicos. 	t	5	\N	\N	\N	\N
119	Learn AngularJS 1.X	Learn how to easily build single-page web applications using this popular JavaScript framework.	t	2	\N	\N	\N	\N
120	Italiano	Curso de 20 niveles de idioma italiano.	t	4	\N	\N	\N	\N
\.


--
-- TOC entry 2361 (class 0 OID 0)
-- Dependencies: 186
-- Name: Diplomados_CodigoDiplomado_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Diplomados_CodigoDiplomado_seq"', 120, true);


--
-- TOC entry 2288 (class 0 OID 19171)
-- Dependencies: 187
-- Data for Name: EstadosParticipantes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "EstadosParticipantes" ("CodigoEstados", "NombreEstado", "Estado", "UsuarioModifica", "IPModifica", "FechaModifica") FROM stdin;
1	Activo	t	\N	\N	\N
2	Inactivo	t	\N	\N	\N
\.


--
-- TOC entry 2362 (class 0 OID 0)
-- Dependencies: 188
-- Name: EstadosParticipantes_CodigoEstados_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"EstadosParticipantes_CodigoEstados_seq"', 2, true);


--
-- TOC entry 2290 (class 0 OID 19179)
-- Dependencies: 189
-- Data for Name: GrupoPeriodos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "GrupoPeriodos" ("CodigoGrupoPeriodo", "CodigoPeriodo", "Estado", "HoraEntrada", "HoraSalida", "Aula") FROM stdin;
2	3	t	06:00:00	08:00:00	S1A
3	3	t	08:00:00	10:00:00	S2A
4	3	t	10:00:00	12:00:00	S2C
5	4	t	06:00:00	08:00:00	A1
6	4	t	08:00:00	10:00:00	A2
7	5	t	10:00:00	12:00:00	1A
8	5	t	13:00:00	15:00:00	3B
9	3	t	03:00:00	04:00:00	s2e
10	23	t	13:01:00	13:59:00	A3
11	23	t	17:00:00	18:00:00	s2b
12	22	t	13:00:00	14:00:00	s2a
13	23	t	12:00:00	13:45:00	s2c
14	22	t	01:00:00	01:59:00	sdas
15	22	t	01:00:00	01:59:00	test
16	22	t	01:00:00	01:59:00	test
17	25	t	01:00:00	01:58:00	asd
18	28	t	02:00:00	01:00:00	ASDASD
19	27	t	04:00:00	02:00:00	asd
20	8	t	08:00:00	10:00:00	S2A
21	8	t	08:00:00	10:00:00	S2A
22	30	t	13:00:00	14:00:00	b2
23	31	t	01:00:00	02:00:00	s2a
24	17	t	11:00:00	12:00:00	e2
25	31	t	08:00:00	09:00:00	a1
26	32	t	08:00:00	09:00:00	a2
27	33	t	16:00:00	17:00:00	b3
28	34	t	09:15:00	10:15:00	a2c
29	36	t	10:15:00	11:25:00	a1
30	37	t	06:45:00	07:35:00	a2
31	38	t	15:30:00	16:20:00	a3
32	39	t	08:25:00	21:15:00	a3
33	40	t	09:15:00	10:05:00	a4
34	36	t	10:05:00	11:15:00	a2b
35	24	t	10:15:00	11:45:00	f1
36	41	t	11:45:00	12:35:00	h2
37	45	t	12:35:00	13:00:00	h22
38	46	t	13:00:00	13:50:00	d9
39	47	t	13:50:00	14:40:00	c5
40	66	t	14:40:00	15:30:00	a3
41	67	t	06:45:00	07:35:00	a3
42	68	t	15:30:00	16:20:00	a9
43	90	t	10:55:00	11:45:00	A12
44	38	t	13:50:00	14:40:00	A8
45	84	t	07:35:00	08:25:00	B3
46	71	t	08:25:00	09:15:00	A6
47	85	t	08:25:00	09:15:00	A12
48	23	t	13:50:00	14:40:00	S1E
49	31	t	19:40:00	20:30:00	S2A
50	74	t	18:00:00	18:50:00	S2C
51	87	t	07:35:00	08:25:00	A10
52	88	t	11:45:00	12:35:00	A9
53	28	t	09:15:00	10:05:00	A1
54	50	t	07:35:00	08:25:00	A1
55	32	t	15:30:00	16:20:00	S1B
56	66	t	07:35:00	08:25:00	A7
57	23	t	10:55:00	11:45:00	B2
58	58	t	14:40:00	15:30:00	S2E
59	9	t	07:35:00	08:25:00	A4
60	70	t	11:45:00	12:35:00	A11
61	24	t	19:40:00	20:30:00	B2
62	53	t	19:40:00	20:30:00	A10
63	20	t	18:00:00	18:50:00	S1A
64	73	t	09:15:00	10:05:00	S2B
65	72	t	12:35:00	13:00:00	A9
66	50	t	11:45:00	12:35:00	S1D
67	59	t	18:50:00	19:40:00	1B
68	87	t	12:35:00	13:00:00	A3
69	38	t	19:40:00	20:30:00	A12
70	19	t	15:30:00	16:20:00	A9
71	73	t	07:35:00	08:25:00	S1A
72	7	t	11:45:00	12:35:00	A12
73	11	t	13:00:00	13:50:00	A9
74	82	t	09:15:00	10:05:00	B3
75	104	t	09:15:00	10:05:00	S1C
76	75	t	19:40:00	20:30:00	S1B
77	49	t	16:20:00	17:10:00	A1
78	10	t	14:40:00	15:30:00	S1E
79	90	t	18:00:00	18:50:00	S2C
80	38	t	07:35:00	08:25:00	S1D
81	38	t	14:40:00	15:30:00	S2E
82	39	t	12:35:00	13:00:00	S1E
83	96	t	15:30:00	16:20:00	A5
84	99	t	07:35:00	08:25:00	S2B
85	5	t	11:45:00	12:35:00	S1A
86	74	t	06:45:00	07:35:00	A8
87	57	t	11:45:00	12:35:00	S1D
88	44	t	14:40:00	15:30:00	A6
89	82	t	16:20:00	17:10:00	S1A
90	62	t	13:50:00	14:40:00	B3
91	56	t	13:00:00	13:50:00	S2B
92	43	t	15:30:00	16:20:00	S2D
93	91	t	19:40:00	20:30:00	S2C
94	47	t	08:25:00	09:15:00	A10
95	16	t	12:35:00	13:00:00	A4
96	50	t	09:15:00	10:05:00	S2D
97	67	t	19:40:00	20:30:00	S1D
98	98	t	07:35:00	08:25:00	A7
99	87	t	18:50:00	19:40:00	S2B
100	95	t	14:40:00	15:30:00	B2
101	4	t	18:50:00	19:40:00	A2
102	20	t	15:30:00	16:20:00	1B
103	21	t	18:50:00	19:40:00	S2A
104	7	t	12:35:00	13:00:00	A7
105	93	t	07:35:00	08:25:00	S2D
106	103	t	16:20:00	17:10:00	1B
107	25	t	16:20:00	17:10:00	A5
108	48	t	13:50:00	14:40:00	A8
109	48	t	09:15:00	10:05:00	S1B
110	10	t	16:20:00	17:10:00	S2A
111	43	t	06:45:00	07:35:00	S1B
112	43	t	11:45:00	12:35:00	S1D
113	31	t	18:50:00	19:40:00	S1A
114	92	t	06:45:00	07:35:00	B2
115	49	t	19:40:00	20:30:00	S2E
116	21	t	16:20:00	17:10:00	S1E
117	14	t	07:35:00	08:25:00	A5
118	67	t	12:35:00	13:00:00	S1A
119	12	t	11:45:00	12:35:00	S1A
120	100	t	18:00:00	18:50:00	S2E
121	28	t	08:25:00	09:15:00	B2
122	13	t	11:45:00	12:35:00	S2A
123	94	t	18:50:00	19:40:00	A5
124	52	t	14:40:00	15:30:00	A2
125	40	t	14:40:00	15:30:00	A3
126	9	t	18:50:00	19:40:00	A11
127	50	t	16:20:00	17:10:00	1B
128	3	t	11:45:00	12:35:00	S2A
129	41	t	08:25:00	09:15:00	S1B
130	94	t	14:40:00	15:30:00	B3
131	72	t	13:50:00	14:40:00	A2
132	75	t	13:50:00	14:40:00	1B
133	47	t	19:40:00	20:30:00	A7
134	89	t	08:25:00	09:15:00	A12
135	30	t	14:40:00	15:30:00	A1
136	45	t	12:35:00	13:00:00	B2
137	30	t	12:35:00	13:00:00	S2B
138	96	t	09:15:00	10:05:00	S1E
139	88	t	06:45:00	07:35:00	A1
140	38	t	12:35:00	13:00:00	A8
141	93	t	16:20:00	17:10:00	A8
142	19	t	11:45:00	12:35:00	S2D
\.


--
-- TOC entry 2363 (class 0 OID 0)
-- Dependencies: 190
-- Name: GrupoPeriodos_CodigoGrupoPeriodo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"GrupoPeriodos_CodigoGrupoPeriodo_seq"', 43, true);


--
-- TOC entry 2292 (class 0 OID 19184)
-- Dependencies: 191
-- Data for Name: GruposMaestros; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "GruposMaestros" ("CodigoGruposPeriodoUsuario", "CodigoUsuario", "CodigoGrupoPeriodo", "Estado") FROM stdin;
1	1	26	0
2	65	26	1
3	26	26	1
4	65	55	1
\.


--
-- TOC entry 2293 (class 0 OID 19187)
-- Dependencies: 192
-- Data for Name: GruposParticipantes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "GruposParticipantes" ("CodigoGruposParticipantes", "CalificacionModulo", "CodigoParticipante", "CodigoEstadosParticipacion", "CodigoUsuario", "CodigoGrupoPeriodo") FROM stdin;
10	0	8	1	1	5
15	0	8	1	1	8
2	0	1	1	1	6
13	0	8	2	1	2
16	0	8	1	1	4
11	0	8	2	1	6
17	0	1	1	1	2
18	0	1	1	2	10
1	0	1	1	1	8
12	0	8	1	1	7
14	0	8	1	1	3
19	0	9	1	2	10
20	0	9	1	2	3
21	0	44	1	1	114
22	0	68	1	1	34
23	0	1	1	1	76
24	0	105	1	1	138
25	0	31	1	1	132
26	0	44	1	1	128
27	0	50	1	1	32
28	0	53	1	1	57
29	0	46	1	1	29
30	0	46	1	1	17
31	0	53	1	1	80
32	0	73	1	1	38
33	0	95	1	1	67
34	0	50	1	1	76
35	0	50	1	1	13
36	0	46	1	1	90
37	0	84	1	1	56
38	0	73	1	1	43
39	0	77	1	1	108
40	0	81	1	1	110
41	0	94	1	1	27
42	0	20	1	1	38
43	0	45	1	1	84
44	0	26	1	1	111
45	0	80	1	1	19
46	0	103	1	1	59
47	0	110	1	1	116
48	0	66	1	1	24
49	0	60	1	1	64
50	0	92	1	1	96
51	0	92	1	1	99
52	0	14	1	1	110
53	0	55	1	1	36
54	0	14	1	1	18
55	0	66	1	1	19
56	0	109	1	1	92
57	0	112	1	1	100
58	0	75	1	1	136
59	0	105	1	1	28
60	0	95	1	1	118
61	0	30	1	1	87
62	0	26	1	1	40
63	0	103	1	1	126
64	0	69	1	1	87
65	0	70	1	1	17
66	0	74	1	1	123
67	0	59	1	1	54
68	0	1	1	1	106
69	0	94	1	1	75
70	0	83	1	1	99
71	0	30	1	1	119
72	0	101	1	1	135
73	0	63	1	1	5
74	0	92	1	1	22
75	0	41	1	1	23
76	0	34	1	1	37
77	0	91	1	1	5
78	0	91	1	1	134
79	0	70	1	1	93
80	0	23	1	1	99
81	0	29	1	1	129
82	0	57	1	1	101
83	0	66	1	1	49
84	0	44	1	1	40
85	0	55	1	1	61
86	0	77	1	1	68
87	0	74	1	1	92
88	0	30	1	1	126
89	0	69	1	1	6
90	0	69	1	1	4
91	0	75	1	1	50
92	0	17	1	1	62
93	0	110	1	1	138
94	0	86	1	1	40
95	0	112	1	1	26
96	0	58	1	1	70
97	0	90	1	1	33
98	0	52	1	1	64
99	0	106	1	1	136
100	0	36	1	1	62
101	0	61	1	1	108
102	0	61	1	1	141
103	0	12	1	1	135
104	0	90	1	1	111
105	0	65	1	1	40
106	0	29	1	1	13
107	0	45	1	1	78
108	0	69	1	1	104
109	0	26	1	1	58
110	0	89	1	1	15
111	0	52	1	1	66
112	0	91	1	1	135
113	0	32	1	1	138
114	0	42	1	1	89
115	0	56	1	1	87
116	0	93	1	1	72
117	0	45	1	1	3
118	0	45	1	1	126
119	0	77	1	1	34
120	0	1	1	2	3
121	0	1	1	2	4
122	0	1	1	2	70
123	0	1	1	2	25
124	0	14	1	2	25
125	0	23	1	2	25
126	0	17	1	2	25
127	0	1	1	2	23
128	0	13	1	2	23
129	0	18	1	2	23
130	0	9	1	2	23
\.


--
-- TOC entry 2364 (class 0 OID 0)
-- Dependencies: 193
-- Name: GruposParticipantes_CodigoGruposParticipantes_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"GruposParticipantes_CodigoGruposParticipantes_seq"', 130, true);


--
-- TOC entry 2365 (class 0 OID 0)
-- Dependencies: 194
-- Name: GruposPeriodoUsuarios_CodigoGruposPeriodoUsuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"GruposPeriodoUsuarios_CodigoGruposPeriodoUsuario_seq"', 4, true);


--
-- TOC entry 2296 (class 0 OID 19194)
-- Dependencies: 195
-- Data for Name: Modulos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Modulos" ("CodigoModulo", "NombreModulo", "OrdenModulo", "Estado", "UsuarioModifica", "IpModifica", "FechaModifica", "CodigoTurno", "CodigoDiplomado", "Comentarios") FROM stdin;
6	Schema Design	3	t	\N	\N	\N	1	101	\N
7	Perfomance	4	t	\N	\N	\N	1	101	\N
8	Aggregation Framework	5	t	\N	\N	\N	1	101	\N
9	Application Engineering	6	t	\N	\N	\N	1	101	\N
10	Case Studies	7	t	\N	\N	\N	1	101	\N
11	Introduction and Overview	1	t	\N	\N	\N	1	102	\N
12	Creating, Reading and Updating	2	t	\N	\N	\N	1	102	\N
13	Performance	3	t	\N	\N	\N	1	102	\N
14	Replication	4	t	\N	\N	\N	1	102	\N
15	Scalability	5	t	\N	\N	\N	1	102	\N
16	Backup and Recovery	6	t	\N	\N	\N	1	102	\N
17	Excel Avanzado	1	t	\N	\N	\N	1	106	\N
18	Programacion Basic	2	t	\N	\N	\N	1	106	\N
19	Diagramas con Visio	3	t	\N	\N	\N	1	106	\N
4	Introduction and Overview	1	t	2	::1	2016-04-16	1	101	afsdfsdg
5	Creating, Reading and Updating	2	f	2	::1	2016-04-16	1	101	test1
23	Módulo 1. Introducción a la inteligencia cultural y su Rol en los Negocios	1	t	\N	\N	\N	1	107	\N
25	Módulo 2. El factor deseo.	2	t	\N	\N	\N	1	107	\N
27	Módulo 3. El factor conocimiento.	3	t	\N	\N	\N	1	107	\N
28	Módulo 4. El factor estrategia.	4	t	\N	\N	\N	1	107	\N
29	Módulo 5. El factor comportamiento.	5	t	\N	\N	\N	1	107	\N
30	Módulo 6. La inteligencia y su uso en los Negocios Internacionles.	6	t	\N	\N	\N	1	107	\N
34	Módulo 1. Introducción al Software Libre	1	t	\N	\N	\N	1	110	\N
35	Módulo 2. Procesador de texto: Writer	2	t	\N	\N	\N	1	110	\N
36	Módulo 3. Hoja de cálculo Calc	3	t	\N	\N	\N	1	110	\N
37	Módulo 4. Cultura Libre	4	t	\N	\N	\N	1	110	\N
38	Módulo 1. Hidrogeología de terrenos volcánicos.	1	t	\N	\N	\N	1	111	\N
41	Módulo 2. Aprovechamiento de los recursos subterráneos.	2	t	\N	\N	\N	1	111	\N
42	Módulo 3. Aprovechamiento de los recursos superficiales.	3	t	\N	\N	\N	1	111	\N
43	Módulo 4. Gestión de los recursos hídricos.	4	t	\N	\N	\N	1	111	\N
44	Módulo 1. Trabajo y Salud	1	t	\N	\N	\N	1	112	\N
45	Módulo 2. Marco Normativo	2	t	\N	\N	\N	1	112	\N
46	Módulo 3. Obligaciones de empresarios y trabajadores	3	t	\N	\N	\N	1	112	\N
47	Módulo 4. Organización de la actividad preventiva	4	t	\N	\N	\N	1	112	\N
48	Módulo 5. Consulta, participación y representación	5	t	\N	\N	\N	1	112	\N
49	Módulo 6. Responsabilidades y sanciones	6	t	\N	\N	\N	1	112	\N
50	Módulo 1. El quirófano	1	t	\N	\N	\N	1	113	\N
52	Módulo 2. Bases generales del comportamiento en el quirófano	2	t	\N	\N	\N	1	113	\N
53	Módulo 3. Principios fundamentales de esterilización y desinfección	3	t	\N	\N	\N	1	113	\N
54	Módulo 4. La rutina quirúrgica completa	4	t	\N	\N	\N	1	113	\N
55	Módulo 5. Los tiempos fundamentales del procedimiento quirúrgico	5	t	\N	\N	\N	1	113	\N
56	Módulo 1. La Gestión Estratégica Eficaz	1	t	\N	\N	\N	1	114	\N
57	Módulo 2. Generando Valor con la Innovación	2	t	\N	\N	\N	1	114	\N
58	Módulo 3. Las Habilidades del Innovador Disruptivo y Disciplinado	3	t	\N	\N	\N	1	114	\N
59	Módulo 4. Construyendo Organizaciones Innovadoras	4	t	\N	\N	\N	1	114	\N
60	Módulo 5. Generando Valor con el Emprendimiento	5	t	\N	\N	\N	1	114	\N
61	Módulo 6. Aporte de la Innovación y el Emprendimiento en la Administración	6	t	\N	\N	\N	1	114	\N
62	Módulo 1. Introducción	1	t	\N	\N	\N	1	115	\N
63	Módulo 2. Curvas y listas	2	t	\N	\N	\N	1	115	\N
64	Módulo 3. Superficies, mallas y árboles	3	t	\N	\N	\N	1	115	\N
65	Módulo 4. Extensiones	4	t	\N	\N	\N	1	115	\N
66	Módulo 1. Introducción, conceptos generales	1	t	\N	\N	\N	1	116	\N
67	Módulo 2. ¿Cómo actúan los medicamentos? Farmacodinámica	2	t	\N	\N	\N	1	116	\N
68	Módulo 3. El viaje de un medicamento a lo largo del organismo. Farmacocinética	3	t	\N	\N	\N	1	116	\N
69	Módulo 4. Cómo afecta la Forma Farmacéutica a la eficacia de los medicamentos	4	t	\N	\N	\N	1	116	\N
70	Módulo 5. Tolerancia y dependencia a medicamentos	5	t	\N	\N	\N	1	116	\N
71	Módulo 6. Efectos adversos de los medicamentos	6	t	\N	\N	\N	1	116	\N
72	Módulo 7. Intoxicación por medicamentos	7	t	\N	\N	\N	1	116	\N
73	Módulo 8. Interacciones entre medicamentos	8	t	\N	\N	\N	1	116	\N
74	Módulo 9. Las etapas de la investigación de un medicamento, ¿de dónde vienen y cómo nacen los nuevos fármacos?	9	t	\N	\N	\N	1	116	\N
75	Módulo 10. Utilización de medicamentos en el embarazo, lactancia, infancia y ancianidad	10	t	\N	\N	\N	1	116	\N
76	Módulo 11. Nuevas terapias. Los medicamentos de origen biológico	11	t	\N	\N	\N	1	116	\N
77	Módulo 1. Generalidades	1	t	\N	\N	\N	1	117	\N
78	Módulo 2. Protozoología	2	t	\N	\N	\N	1	117	\N
79	Módulo 3. Helmintología	3	t	\N	\N	\N	1	117	\N
80	Módulo 4. Artropodología	4	t	\N	\N	\N	1	117	\N
81	Lección 1: Construir software no es como construir coches o casas	1	t	\N	\N	\N	1	118	\N
82	Lección 2: Peopleware	2	t	\N	\N	\N	1	118	\N
83	Lección 3: El “Product Owner” y las historias de usuario	3	t	\N	\N	\N	1	118	\N
84	Lección 4: Scrum	4	t	\N	\N	\N	1	118	\N
85	Lección 5: La planificación ágil	5	t	\N	\N	\N	1	118	\N
86	Lección 6: Lean y Kanban	6	t	\N	\N	\N	1	118	\N
87	Lección 7: Deuda Técnica y Testing Ágil	7	t	\N	\N	\N	1	118	\N
88	UNIT 1: YOUR FIRST APP	1	t	\N	\N	\N	1	119	\N
89	UNIT 2: DIRECTIVES\r\n}	2	t	\N	\N	\N	1	119	\N
90	UNIT 3: SERVICES	3	t	\N	\N	\N	1	119	\N
91	UNIT 4: ROUTING	4	t	\N	\N	\N	1	119	\N
92	UNIT 5: PUTTING IT ALL TOGETHER\r\n	5	t	\N	\N	\N	1	119	\N
93	Nivel 1	1	t	\N	\N	\N	1	120	\N
94	Nivel 2	2	t	\N	\N	\N	1	120	\N
95	Nivel 3	2	t	\N	\N	\N	1	120	\N
96	Nivel 4	2	t	\N	\N	\N	1	120	\N
97	Nivel 5	2	t	\N	\N	\N	1	120	\N
\.


--
-- TOC entry 2366 (class 0 OID 0)
-- Dependencies: 196
-- Name: Modulos_CodigoModulo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Modulos_CodigoModulo_seq"', 97, true);


--
-- TOC entry 2298 (class 0 OID 19202)
-- Dependencies: 197
-- Data for Name: Participantes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Participantes" ("CodigoParticipante", "CorreoElectronico", "TelefonoFijo", "TelefonoCelular", "Direccion", "NumeroDUI", "Nombre", "FechaNacimiento", "CodigoUniversidadProcedencia", "Carrera", "NivelAcademico", "NombreEncargado", "Descripcion", "UsuarioModifica", "IPModifica", "FechaModifica", "CodigoCategoriaParticipantes", "Comentarios", "Genero", "CarnetAlumno") FROM stdin;
1	maynor.lopez@partsplussv.com	24414545	75982304	sdasda	04440101	Maynor Lopez	1991-04-18	0				test4	0	192.168.1.1	2016-04-30	2	test4	M	\N
9	mari.gar@pp.com	1231-2312	1231-2312	Av. Las Flores, Residencial Constitucion, #15	98795384-7	Marisol Garcia	1991-11-20	0	Lic. en Idiomas	Bachiller		Desde cero	0	192.168.1.1	2016-07-05	2	cero	F	\N
12	kevin.linares@paesis.com	2441-4545	7748-5984	1 AV. SUR CASA #6-9, BARRIO STA. CRUZ. AHUACHAPAN.	04160177-4	Kevin Linares	1998-07-22	0	Lic. En Idiomas Extrangeros	Estudiante	POLANCO MARTINEZ,  NELSON WILFREDO	 	2	192.168.0.2	2015-01-01	5	Ninguno.	M	\N
13	roberto.leon@paesis.com	2441-4546	7748-5985	RESIDENCIAL EL TREBOL SENDA LOS PINOS PJE.#23 C#24	04160178-2	Roberto Leon	1993-12-15	4	Lic. En Contaduria Publica.	Tecnico		Reingreso 	2	192.168.0.3	2015-01-02	3	Ninguno.	M	\N
14	sarai.corado@paesis.com	2441-4547	7748-5986	URB. SANTA ANA NORTE, POLIG."F", CASA #25, SANTA ANA	04160179-0	Sarai Corado	1980-12-05	1	Ing. Quimica	Tecnico		entrada por estudios previos.	2	192.168.0.4	2015-01-03	2	Ninguno.	F	\N
15	henry.valle@paesis.com	2441-4548	7748-5987	FINAL 5 C. OTE. REPARTO TAZUMAL CASA #3;CHALCHUAPA	04160180-9	Henry Valle	1983-03-13	4	Lic. En ciencias Juridicas	Egresado		Se retiro	2	192.168.0.5	2015-01-04	3	Ninguno.	M	\N
16	humberto.muller@paesis.com	2441-4549	7748-5988	COL. LAMATEPEC ZONA D PLG.B PJE. B #10            	04160181-4	Humberto Muller	1991-07-09	0	Por Determinar	Tecnico		Entrada por examen de reubicacion	2	192.168.0.6	2015-01-05	5	Ninguno.	F	\N
17	sofia.muller@paesis.com	2441-4550	7748-5989	URB. STA. ANA NORTE POLG. 15 #31, SANTA ANA                  	04160182-2	Sofia Muller	1998-12-14	0	Lic. En Geofisica	Estudiante	MENDEZ ESCALANTE,  LUIS ALONSO	 	2	192.168.0.7	2015-01-06	4	Ninguno.	M	\N
18	ademir.arevalo@paesis.com	2441-4551	7748-5990	CTON.PRIMAVERA,LOF.ALTAMIRA,POL.#1 CASA #8 STA.ANA	04160183-4	Ademir Arevalo	1997-06-22	3	Tecnico	Egresado		entrada por estudios previos.	2	192.168.0.8	2015-01-07	2	Ninguno.	M	\N
19	immer.rojas@paesis.com	2441-4552	7748-5991	POL 22,C#31,PASAJE F RESID. JARDINES DEL TECANA   	04160184-0	Immer Rojas	1997-06-27	6	Ing. Industrial	Egresado		 	2	192.168.0.9	2015-01-08	5	Ninguno.	F	\N
20	estela.gonzales@paesis.com	2441-4553	7748-5992	COL. EL PALMAR PJE. GUATEMALA C#48                	04160185-5	Estela Gonzales	1989-06-01	6	Lic. En Mercadeo	Estudiante		 	2	192.168.0.10	2015-01-09	3	Ninguno.	F	\N
21	ana.landaverde@paesis.com	2441-4554	7689-4563	11 CALLE OTE. E.9/11 AV. SUR #24                  	04160186-5	Ana Landaverde	1980-11-24	6	Lic. En Fisica	Tecnico		 	2	192.168.0.11	2015-01-10	5	Ninguno.	F	\N
22	roni.gutierrez@paesis.com	2441-4555	7689-4564	URB. CIUDAD PARAISO, PLG. 10 PJE.10, C#29         	04160187-8	Roni Gutierrez	1985-06-12	6	Lic. En Psicologia	Profesional		 	2	192.168.0.12	2015-01-11	5	Ninguno.	M	\N
23	brenda.solis@paesis.com	2441-4556	7689-4565	URB. JARDINES DE BARCELONA BLK. C CASA #8         	04160188-0	Brenda Solis	1993-11-03	4	Lic. En Contaduria Publica.	Tecnico		Reingreso 	2	192.168.0.13	2015-01-12	1	Ninguno.	F	\N
24	norma.solis@paesis.com	2441-4557	7689-4566	AV, INDEPENDENCIA SUR. #23 SANTA ANA              	04160189-7	Norma Solis	1993-06-22	6	Lic. En ciencias Juridicas	Egresado		Reingreso 	2	192.168.0.14	2015-01-13	2	Ninguno.	F	\N
25	cesia.solis@paesis.com	2441-4558	7689-4567	17 CALLE OTE. 3 Y 4 AV. SUR.#70                   	04160190-8	Cesia Solis	1996-12-06	2	Lic. En Mercadeo	Estudiante		 	2	192.168.0.15	2015-01-14	1	Ninguno.	F	\N
26	emilia.solis@paesis.com	2441-4559	7689-4568	ENTRE 29 Y 31 CALLE PONIENTE  COL. FERROCARIL#53  	04160191-2	Emilia Solis	1983-04-13	5	Ing. Industrial	Profesional		entrada por beca	2	192.168.0.16	2015-01-15	3	Ninguno.	F	\N
27	ivan.retana@paesis.com	2441-4560	7689-4569	COL.IVU PSJE. 6 PTE. #51.                         	04160192-6	Ivan Retana	1996-11-18	5	Ing. Agropecuaria	Tecnico		entrada por estudios previos.	2	192.168.0.17	2015-01-16	5	Ninguno.	M	\N
28	gerardo.escobar@paesis.com	2441-4561	7689-4570	13 CALLE PTE. E 6/8 AV. SUR                       	04160193-4	Gerardo Escobar	1986-03-19	0	Ing. En Sistemas Informaticos	Tecnico		Reingreso 	2	192.168.0.18	2015-01-17	2	Ninguno.	M	\N
29	sergio.martinez@paesis.com	2441-4562	7689-4571	BARRIO SAN ANTONIO CALLE CHALCHUAPA F ESC. GUATEMA	04160194-3	Sergio Martinez	1987-07-16	2	Ing. Civil	Egresado		 	2	192.168.0.19	2015-01-18	4	Ninguno.	M	\N
30	jessica.saracay@paesis.com	2441-4563	7689-4572	RES. ALTOS DE SANTA LUCIA 2 POL #19 PJE. B #29, Santa ana    	04160195-3	Jessica Saracay	1995-12-01	0	Lic. En Fisica	Profesional		entrada por beca	2	192.168.0.20	2015-01-19	4	Ninguno.	F	\N
31	mariela.mancia@paesis.com	2441-4564	7689-4573	COL. LA EMPANIZADA FINCA EMPANIZADA               	04160196-1	Mariela Mancia	1999-07-04	2	Lic. En Fisica	Estudiante	GUDIEL CASTRO, DOUGLAS MILTON	Reingreso 	2	192.168.0.21	2015-01-20	4	Ninguno.	F	\N
32	iris.vanegas@paesis.com	2441-4565	7689-4574	URB. BUENOS AIRES POL.F #16                       	04160197-6	Iris Vanegas	1986-06-10	3	Lic. En Quimica	Estudiante		entrada por estudios previos.	2	192.168.0.22	2015-01-21	4	Ninguno.	F	\N
33	iliana.rivera@paesis.com	2441-4566	7689-4575	URB. LAS BRISAS POLG. A #9                        	04160198-3	Iliana Rivera	1996-12-05	4	Lic. En Idiomas Extrangeros	Estudiante		entrada por beca	2	192.168.0.23	2015-01-22	2	Ninguno.	F	\N
34	armando.rodrigues@paesis.com	2441-4567	7145-8756	COLONIA CARRASCO#7 BLOCK. B ,CHALCHUAPA           	04160199-2	Armando Rodrigues	1985-02-27	0	Tecnico	Egresado		 	2	192.168.0.24	2015-01-23	1	Ninguno.	M	\N
35	moises.espana@paesis.com	2441-4568	7145-8757	C. PRINCIPAL AV. TTE. RICARDO MANCIA #32 BO.EL CON	04160200-2	Moises Espana	1986-10-25	4	Lic. En Fisica	Profesional		 	2	192.168.0.25	2015-01-24	4	Ninguno.	M	\N
36	jose.salguero@paesis.com	2441-4569	7145-8758	CANTON PRIMAVERA, LOT. PRESIDENCIA PLG. #36 LOTE#1	04160201-8	Jose Salguero	1991-05-03	3	Doctorado en Medicina	Tecnico		 	2	192.168.0.26	2015-01-25	3	Ninguno.	M	\N
37	juan.gonzalez@paesis.com	2441-4570	7145-8759	FINAL 17 AV. SUR. B ANGEL COL. GUZMAN #5          	04160202-5	Juan Gonzalez	1994-08-10	4	Ing. Quimica	Estudiante		entrada por estudios previos.	2	192.168.0.27	2015-01-26	3	Ninguno.	M	\N
39	melissa.alvarenga@paesis.com	2441-4572	7145-8761	B. EL ANGEL 8 AV. SUR 3-272, Atiquizaya                       	04160204-0	Melissa Alvarenga	1985-03-13	1	Lic. En Idiomas Extrangeros	Profesional		Se retiro	2	192.168.0.29	2015-01-28	3	Ninguno.	F	\N
40	jorge.diaz@paesis.com	2441-4573	7145-8762	BARRIO SAN ANTONIO COL. EL PROGRESO SECTOR#2 C#124-A, Santa ana	04160205-6	Jorge Diaz	1990-03-08	3	Lic. En Biologia	Profesional		entrada por estudios previos.	2	192.168.0.30	2015-02-01	5	Ninguno.	M	\N
42	kare.medina@paesis.com	2441-4575	7145-8764	COL. BOSQUES DE ANCAR POLIG. "D", CASA #4, EL CONGO, SANTA ANA	04160207-4	Kare Medina	1996-12-15	0	Lic. En Biologia	Estudiante		 	2	192.168.0.32	2015-02-03	4	Ninguno.	F	\N
43	daisy.lopez@paesis.com	2441-4576	7515-4923	BARRIO EL CALVARIO AV. BENJAMIN ESTRADA VALIENTE #31, METAPAN SANTA ANA.           	04160208-7	Daisy Lopez	1996-11-15	6	Lic. En Idiomas Extrangeros	Estudiante		Reingreso 	2	192.168.0.33	2015-02-04	2	Ninguno.	F	\N
44	jose.velado@paesis.com	2441-4577	7515-4924	Urb. El trebol, 3º etapa, pol. 19, casa #8, Santa Ana.             	04160209-1	Jose Velado	1994-04-17	2	Lic. En Idiomas Extrangeros	Tecnico		 	2	192.168.0.34	2015-02-05	2	Ninguno.	M	\N
45	monica.melendez@paesis.com	2441-4578	7515-4925	URB. SANTA ANA NORTE, CALLE "E", POLIG.#4, CASA #35, SANTA ANA	04160210-5	Monica Melendez	1999-02-03	0	Por Determinar	Estudiante	RETANA CASTRO,  YENI LORENA	 	2	192.168.0.35	2015-02-06	2	Ninguno.	F	\N
46	gabriela.castro@paesis.com	2441-4579	7515-4926	CANTON PRIMAVERA COL. SANTO TOMAS, LOTIF. EXCUELLAR, CALLE PRINCIPAL LOTE #23, SANTA ANA	04160211-6	Gabriela Castro	1981-07-15	4	Doctorado en Medicina	Estudiante		 	2	192.168.0.36	2015-02-07	5	Ninguno.	F	\N
47	gabriela.flores@paesis.com	2441-4580	7515-4927	COL. LAS TEKAS #12 CANTON RANCHADOR               	04160212-3	Gabriela Flores	1994-03-22	5	Ing. En Sistemas Informaticos	Egresado		 	2	192.168.0.37	2015-02-08	5	Ninguno.	F	\N
49	gabriela.menedez@paesis.com	2486-1201	7515-4929	COLONIA LOS PINOS, CALLE ARGENTINA #45            	04160214-7	Gabriela Menedez	1998-04-25	1	Ing. En Sistemas Informaticos	Tecnico	ARGUMEDO,  PATRICIA CAROLINA	Se retiro	2	192.168.0.39	2015-02-10	1	Ninguno.	F	\N
50	nath.menedez@paesis.com	2486-1202	7515-4930	RESIDENCIAL BELLA VISTA #2 AV. BELLA VISTA POL.2 #2, SANTA ANA	04160215-1	Nath Menedez	1998-09-16	4	Lic. En Geofisica	Estudiante	TORRES MENDEZ, MARITZA YANIRA	 	2	192.168.0.40	2015-02-11	1	Ninguno.	F	\N
51	andrea.diaz@paesis.com	2486-1203	7515-4931	CANTON CANTARRANA, COL. OLIMPIA , C. PRINCIPAL#8  	04160216-5	Andrea Diaz	1998-09-02	3	Lic. En Biologia	Profesional	GUERRA,  LUISA ARIANA	Entrada por examen de reubicacion	2	192.168.0.41	2015-02-12	4	Ninguno.	F	\N
52	ivonne.siguenza@paesis.com	2486-1204	7145-8764	CANTON PRIMAVERA,CASERIO PRIMAVERA                	04160217-8	Ivonne Siguenza	1982-10-25	1	Doctorado en Medicina	Egresado		 	2	192.168.0.42	2015-02-13	4	Ninguno.	F	\N
53	ivania.quezada@paesis.com	2486-1205	7145-8765	COL. JARDINES DEL TECANA POL.1 #7                 	04160218-3	Ivania Quezada	1995-08-11	1	Ing. En Sistemas Informaticos	Estudiante		Reingreso 	2	192.168.0.43	2015-02-14	2	Ninguno.	F	\N
54	diana.linares@paesis.com	2486-1206	7145-8766	RES. SAN FRANCISCO C. CIRCUNVALACION BLK.A #12    	04160219-4	Diana Linares	1983-10-18	6	Lic. En Estadistica	Tecnico		 	2	192.168.0.44	2015-02-15	4	Ninguno.	F	\N
55	liliana.jimenez@paesis.com	2486-1207	7145-8767	RES. SAN ERNESTO AV. MORALES BLK.1 POL.C #21 SOYAP	04160220-1	Liliana Jimenez	1987-03-24	1	Lic. En Mercadeo	Estudiante		 	2	192.168.0.45	2015-02-16	2	Ninguno.	F	\N
56	ligia.diaz@paesis.com	2486-1208	7145-8768	RES. ALTAVISTA AV. C.#279 TONACATEPEQUE           	04160221-5	Ligia Diaz	1996-11-02	2	Ing. Industrial	Profesional		entrada por estudios previos.	2	192.168.0.46	2015-02-17	1	Ninguno.	F	\N
57	rosibel.coralia@paesis.com	2486-1209	7145-8769	CALLE B BLK. J CASA #3 COLONIA SAN MARCOS         	04160222-3	Rosibel Coralia	1997-11-01	0	Lic. En Quimica	Egresado		 	2	192.168.0.47	2015-02-18	1	Ninguno.	F	\N
58	karla.velazquez@paesis.com	2486-1210	7145-8770	C. PINO,COL. NAVAS PJE. EL PROGRESO BLK. B #8 SOYAPANGO.	04160223-9	Karla Velazquez	1985-06-04	5	Ing. En Sistemas Informaticos	Estudiante		entrada por estudios previos.	2	192.168.0.48	2015-02-19	4	Ninguno.	F	\N
59	kathya.lopez@paesis.com	2486-1211	7515-4931	Km. 21 1/2, carrtera a Santa ana, Colonia 20 de octubre, pol. H, #6.                 	04160224-6	Kathya Lopez	1985-04-04	2	Lic. En Fisica	Estudiante		Entrada por examen de reubicacion	2	192.168.0.49	2015-02-20	5	Ninguno.	F	\N
60	fatima.ramirez@paesis.com	2486-1212	7515-4932	CONDOMINIO VICTORIA POL. L C#A BOUL. DEL EJERCITO 	04160225-3	Fatima Ramirez	1989-05-15	4	Lic. En Mercadeo	Egresado		 	2	192.168.0.50	2015-02-21	4	Ninguno.	F	\N
61	diana.magana@paesis.com	2486-1213	7515-4933	URB. VILLA LOURDES PLG. R PSJ. 3 #14, Lourdes Colón.             	04160226-6	Diana Magana	1989-01-13	2	Lic. En Sociologia	Egresado		 	2	192.168.0.51	2015-02-22	5	Ninguno.	F	\N
62	carolina.gutierrez@paesis.com	2486-1214	7515-4934	URB. VILLA LOURDES COLON DEPTO DE LIBERTAD        	04160227-7	Carolina Gutierrez	1984-03-03	2	Ing. Civil	Profesional		entrada por estudios previos.	2	192.168.0.52	2015-02-23	2	Ninguno.	F	\N
63	tatiana.navas@paesis.com	2486-1215	7515-4935	URB. LA CORUÑA#2 PJE. 2 #49A SOYAPANGO            	04160228-4	Tatiana Navas	1981-03-08	1	Ing. Quimica	Tecnico		entrada por estudios previos.	2	192.168.0.53	2015-02-24	4	Ninguno.	F	\N
64	violeta.mazariego@paesis.com	2486-1216	7515-4936	FINAL C.  LA MONTREAL VIA GUADALUPE#121           	04160229-3	Violeta Mazariego	1990-11-27	5	Lic. En Mercadeo	Egresado		Reingreso 	2	192.168.0.54	2015-02-25	5	Ninguno.	F	\N
65	kenia.blanco@paesis.com	2486-1217	7515-4937	URB. LA CORUÑA #2 PJE. CASA#49A                   	04160230-7	Kenia Blanco	1993-09-24	2	Lic. Ciencias de la Educacion	Tecnico		Entrada por examen de reubicacion	2	192.168.0.55	2015-02-26	4	Ninguno.	F	\N
66	angelica.andaluz@paesis.com	2486-9110	7515-4938	RES. BETHANIA PSJ. 2 CASA#24D SANTA TECLA         	04160231-2	Angelica Andaluz	1986-08-06	0	Lic. En Contaduria Publica.	Estudiante		entrada por beca	2	192.168.0.56	2015-03-01	3	Ninguno.	F	\N
67	claudia.jordan@paesis.com	2486-9111	7689-4575	LOT. LAS DISPENSAS LOTE#3 C A SAN JOSE VILLA N. SA	04160232-5	Claudia Jordan	1981-10-08	6	Lic. En Estadistica	Egresado		 	2	192.168.0.57	2015-03-02	5	Ninguno.	F	\N
68	abigail.rodriguez@paesis.com	2486-9112	7689-4576	COL. ENTRE RIOS PJE. SUMPUL CASA#116A CIUD.DELGADO	04160233-7	Abigail Rodriguez	1996-03-17	5	Ing. En Sistemas Informaticos	Tecnico		Reingreso 	2	192.168.0.58	2015-03-03	5	Ninguno.	F	\N
69	alma.segovia@paesis.com	2486-9113	7689-4577	COL. RIO ZARCO SECTOR #2 ACCESO#19 C#11           	04160234-4	Alma Segovia	1984-07-26	1	Lic. En Psicologia	Profesional		Se retiro	2	192.168.0.59	2015-03-04	4	Ninguno.	F	\N
70	jeaneth.valencia@paesis.com	2486-9114	7689-4578	Comuinidad Modelo Charlotte, Santa Ana             	04160235-8	Jeaneth Valencia	1990-09-01	0	Lic. En Contaduria Publica.	Profesional		 	2	192.168.0.60	2015-03-05	4	Ninguno.	F	\N
102	luis.lemus@paesis.com	2255-7830	7251-7192	BO. SAN ANTONIO CALLE CLESA #5 SANTA ANA          	04160267-6	Luis Lemus	1985-08-07	6	Lic. En Geofisica	Estudiante		 	2	192.168.0.92	2015-04-08	5	Ninguno.	M	\N
72	vanessa.puquirre@paesis.com	2486-9116	7689-4580	COL. SAN MATEO CALLE BOGOTA #16                   	04160237-0	Vanessa Puquirre	1990-08-21	1	Ing. Agropecuaria	Tecnico		Reingreso 	2	192.168.0.62	2015-03-07	1	Ninguno.	F	\N
73	blanca.mancia@paesis.com	2486-9117	7689-4581	CIUDAD CREDISA PJE. LEMPA#210 SOYAPANGO           	04160238-7	Blanca Mancia	2000-02-01	0	Doctorado en Medicina	Estudiante	GAMEZ GUATEMALA,  RAFAEL	Se retiro	2	192.168.0.63	2015-03-08	1	Ninguno.	F	\N
74	karla.palencia@paesis.com	2486-9118	7689-4582	B. LA VEGA CALLE FELIPE SOTO #618 SAN JACINTO     	04160239-7	Karla Palencia	2000-10-05	2	Lic. En Administracion de Empresas	Estudiante	ARANA CALVIO,  OSCAR HUMBERTO	Reingreso 	2	192.168.0.64	2015-03-09	3	Ninguno.	F	\N
75	fabiola.driottez@paesis.com	2486-9119	7689-4583	URB. JACARANDA POL. 12 APOPA                      	04160240-2	Fabiola Driottez	1985-09-16	4	Lic. En Idiomas Extrangeros	Profesional		 	2	192.168.0.65	2015-03-10	5	Ninguno.	F	\N
76	edda.larin@paesis.com	2486-9120	7689-4584	COL. JARDINES DEL TECANA PJE. A POLIG. 1 #14      	04160241-5	Edda Larin	1986-10-15	2	Ing. Industrial	Egresado		Entrada por examen de reubicacion	2	192.168.0.66	2015-03-11	1	Ninguno.	F	\N
77	katya.saenz@paesis.com	2486-9121	7923-6665	PJE. LAS CRUCES POLG. K6 CASA#12 URB. EL TREBOL   	04160242-5	Katya Saenz	1980-05-24	0	Lic. En Idiomas Extrangeros	Profesional		 	2	192.168.0.67	2015-03-12	3	Ninguno.	F	\N
78	silvia.coreas@paesis.com	2486-9122	7923-6666	COL. SENSUNAPAN PJE. 3 CASA #20, Sonsonate                   	04160243-3	Silvia Coreas	1983-07-18	0	Lic. En ciencias Juridicas	Tecnico		 	2	192.168.0.68	2015-03-13	5	Ninguno.	F	\N
79	beatriz.arteaga@paesis.com	2653-5310	7923-6667	FINAL 22 AV. SUR E/ 29 Y 31 C. PTE. C#20, Santa ana          	04160244-1	Beatriz Arteaga	1983-01-23	4	Doctorado en Medicina	Profesional		 	2	192.168.0.69	2015-03-14	1	Ninguno.	F	\N
80	reina.marroquin@paesis.com	2653-5311	7923-6668	COL. SAN JULIAN PJE. 4 BLOCK4 CASA #7 ACAJUTLA    	04160245-1	Reina Marroquin	1991-03-27	1	Lic. En Sociologia	Profesional		Se retiro	2	192.168.0.70	2015-03-15	5	Ninguno.	F	\N
81	joel.genovez@paesis.com	2653-5312	7923-6669	PARCELACION SANTA CURZ, CHALCHUAPA                	04160246-3	Joel Genovez	1984-08-07	5	Por Determinar	Profesional		entrada por beca	2	192.168.0.71	2015-03-16	3	Ninguno.	M	\N
82	miguel.mena@paesis.com	2653-5313	7923-6670	COL. SENSUNAPAN #2 ACCESO #4 #10                  	04160247-3	Miguel Mena	1989-03-17	1	Lic. En ciencias Juridicas	Estudiante		Reingreso 	2	192.168.0.72	2015-03-17	3	Ninguno.	M	\N
83	karen.linares@paesis.com	2653-5314	7923-6671	21 C OTE. #2-3 COL. 14 DE DICIEMBRE, SONSONATE                	04160248-1	Karen Linares	1999-11-11	3	Lic. En Mercadeo	Estudiante	RODRIGUEZ MONTENEGRO, PATRICIA IVONNE	 	2	192.168.0.73	2015-03-18	3	Ninguno.	F	\N
84	oswaldo.mejia@paesis.com	2653-5315	7923-6672	URB. UMBRES DE SAN BARTOLO PJE.A POL. 6 #13 TONACA	04160249-9	Oswaldo Mejia	1992-12-24	3	Ing. Industrial	Estudiante		entrada por beca	2	192.168.0.74	2015-03-19	5	Ninguno.	M	\N
85	manuel.monroy@paesis.com	2653-5316	7923-6673	KM 23 1/2 AUTOPISTA A COMALAPA REPTO. MONTELIMAR  	04160250-2	Manuel Monroy	1980-06-17	4	Lic. En Estadistica	Estudiante		 	2	192.168.0.75	2015-03-20	4	Ninguno.	M	\N
86	jenniffer.martinez@paesis.com	2653-5317	7923-6674	CANTON PRIMAVERA CASERIO GUIROLA #41              	04160251-8	Jenniffer Martinez	1984-12-22	2	Lic. En Estadistica	Estudiante		Entrada por examen de reubicacion	2	192.168.0.76	2015-03-21	2	Ninguno.	F	\N
87	josselyn.castro@paesis.com	2653-5318	7923-6675	CANTON OBRAJUELO, QUELEPA                         	04160252-4	Josselyn Castro	1984-11-16	3	Ing. En Sistemas Informaticos	Egresado		 	2	192.168.0.77	2015-03-22	1	Ninguno.	F	\N
88	karen.miranda@paesis.com	2653-5319	7923-6676	RES. LA PRADERA 1 POL. N, #6 CASA 40, SAN MIGUEL.              	04160253-1	Karen Miranda	1998-01-10	4	Lic. En Sociologia	Profesional		Se retiro	2	192.168.0.78	2015-03-23	3	Ninguno.	F	\N
89	isabel.quijada@paesis.com	2653-5320	7923-6677	COL. LAS CONCHITAS1 CALLE PRINCIPAL #1 BERLIN     	04160254-5	Isabel Quijada	1984-07-23	5	Lic. En Idiomas Extrangeros	Tecnico		Se retiro	2	192.168.0.79	2015-03-24	3	Ninguno.	F	\N
90	carlos.carcamo@paesis.com	2653-5321	7923-6678	CANTON CONACASTES ARRIBA, RECINOS TRES            	04160255-7	Carlos Carcamo	1993-03-01	6	Lic. En Sociologia	Profesional		Reingreso 	2	192.168.0.80	2015-03-25	3	Ninguno.	M	\N
91	erick.mancia@paesis.com	2653-5322	7251-7181	URB. CIERRA MORENA 1 POL 11 #60, SOYAPANGO                   	04160256-7	Erick Mancia	1990-10-15	0	Lic. En Psicologia	Egresado		Entrada por examen de reubicacion	2	192.168.0.81	2015-03-26	1	Ninguno.	M	\N
92	walter.recinos@paesis.com	2653-5323	7251-7182	COL. ALPES SUIZOS#1 PSJ. ROTTERDAN C#14 SANTA TECL	04160257-5	Walter Recinos	1990-03-15	2	Ing. Agropecuaria	Estudiante		entrada por estudios previos.	2	192.168.0.82	2015-03-27	3	Ninguno.	M	\N
93	josue.lorenzana@paesis.com	2653-5324	7251-7183	FINCA LOS ANGELES CANTON CANTARRANA               	04160258-0	Josue Lorenzana	1996-01-07	3	Lic. En Mercadeo	Estudiante		Reingreso 	2	192.168.0.83	2015-03-28	3	Ninguno.	M	\N
94	adriana.rodriguez@paesis.com	2653-5325	7251-7184	Urbanización Santa Ana Norte, pol 20, casa 34, Santa Ana.              	04160259-4	Adriana Rodriguez	1991-08-09	2	Ing. Civil	Estudiante		Se retiro	2	192.168.0.84	2015-03-29	5	Ninguno.	F	\N
95	danilo.rivas@paesis.com	2255-7823	7251-7185	C/PRIMAVERA CANTON PRIMAVERONA                    	04160260-4	Danilo Rivas	1989-06-20	2	Lic. En ciencias Juridicas	Tecnico		Se retiro	2	192.168.0.85	2015-04-01	3	Ninguno.	M	\N
96	luis.rivas@paesis.com	2255-7824	7251-7186	PLANES DEL RANCHADOR, LOT. EL JORDAN,#11          	04160261-2	Luis Rivas	1987-04-19	1	Lic. En Administracion de Empresas	Tecnico		 	2	192.168.0.86	2015-04-02	4	Ninguno.	M	\N
97	eli.argueta@paesis.com	2255-7825	7251-7187	LOMA LINDA BLOCK.3 #35 EL PORTEZUELO, Santa Ana             	04160262-1	Eli Argueta	1996-05-10	0	Ing. Civil	Egresado		 	2	192.168.0.87	2015-04-03	5	Ninguno.	M	\N
98	diego.mendoza@paesis.com	2255-7826	7251-7188	COL. BUENOS AIRES CANTON LOURDES #36              	04160263-7	Diego Mendoza	1980-02-15	1	Por Determinar	Egresado		Se retiro	2	192.168.0.88	2015-04-04	5	Ninguno.	M	\N
99	nanci.maravilla@paesis.com	2255-7827	7251-7189	COL. 15 DE SEP. AV. CHARLAIX #4, San Miguel                   	04160264-3	Nanci Maravilla	1984-05-10	2	Lic. En ciencias Juridicas	Estudiante		Reingreso 	2	192.168.0.89	2015-04-05	4	Ninguno.	F	\N
100	iliana.castillo@paesis.com	2255-7828	7251-7190	COL. BELLA SAMARIA BLOCK A SENDA B C#34           	04160265-8	Iliana Castillo	1987-07-20	4	Ing. Quimica	Tecnico		 	2	192.168.0.90	2015-04-06	5	Ninguno.	F	\N
101	fatima.roser@paesis.com	2255-7829	7251-7191	COL. SAN JOSE CALLE PRINCIPAL PJE. #2 MEJICANOS   	04160266-3	Fatima Roser	1991-11-02	1	Tecnico	Tecnico		entrada por estudios previos.	2	192.168.0.91	2015-04-07	5	Ninguno.	F	\N
8	Johanna@hotmail.com	1231-2312	1231-2312	hghgjuykjhftgnvghbnn	02384759-1	Johanna  DE   GUERRERO	2015-11-20	0	Ing. sistemas			inicio en nivel 4	0	192.168.1.1	2016-05-02	1	Examen de ubicacion	F	\N
38	jazmin.lira@paesis.com	2441-4571	7145-8760	Colonia Rio zarco 3, Avenida El Pinalito, Santa ana          	04160203-5	Jazmin Lira	1989-03-17	6	Lic. En Administracion de Empresas	Profesional		entrada por estudios previos.	2	192.168.0.28	2015-01-27	1	Ninguno.	F	\N
41	mariano.vargas@paesis.com	2441-4574	7145-8763	FINAL 8 AV. NTE. Y 14 C. PTE. PSJE. 10 C#1        	04160206-9	Mariano Vargas	1986-12-03	0	Lic. En ciencias Juridicas	Estudiante		Se retiro	2	192.168.0.31	2015-02-02	1	Ninguno.	M	\N
48	gabriela.hernandez@paesis.com	2486-1200	7515-4928	CANTON SAN JUAN BUENAVISTA  CASERIIO LAS CANOAS   	04160213-8	Gabriela Hernandez	1999-04-07	0	Ing. En Sistemas Informaticos	Estudiante	RUANO GONZALEZ,  WILLIAM EDENILSON	Reingreso 	2	192.168.0.38	2015-02-09	1	Ninguno.	F	\N
71	nancy.moran@paesis.com	2486-9115	7689-4579	COL. LA CORUÑA#2 PJE. 2 CASA #18-B SOYAPANGO      	04160236-4	Nancy Moran	2000-08-22	3	Lic. En Administracion de Empresas	Estudiante	MORAN GARCIA,  JOSE SANTIAGO	entrada por estudios previos.	2	192.168.0.61	2015-03-06	4	Ninguno.	F	\N
103	oswaldo.barraza@paesis.com	2255-7831	7251-7193	RES. VILLA LOS ANGELES PJE. 7                     	04160268-0	Oswaldo Barraza	1982-11-07	2	Lic. En Biologia	Tecnico		entrada por beca	2	192.168.0.93	2015-04-09	4	Ninguno.	M	\N
104	obs.sandoval@paesis.com	2255-7832	7352-1932	Ciudad Real, Residencial Valladolid, pol 4, #27, carretera a Chalchuapa, Santa Ana.              	04160269-7	Obs Sandoval	1995-08-05	6	Ing. Agropecuaria	Tecnico		 	2	192.168.0.94	2015-04-10	4	Ninguno.	M	\N
105	gabriela.estrada@paesis.com	2255-7833	7352-1933	URB. MONTES DE SAN BARTOLO 4 POL. 48 #22          	04160270-8	Gabriela Estrada	1998-07-13	6	Lic. En Mercadeo	Estudiante	GUARDADO ROMERO,  MARIO ANTONIO	entrada por beca	2	192.168.0.95	2015-04-11	5	Ninguno.	F	\N
106	kath.artero@paesis.com	2255-7834	7352-1934	LOTIFICACION TIERRAS BARATAS POLIGONO D LOTE # 98, COLONIA RIO ZARCO, 1° ETAPA, SANTA ANA 	04160271-2	Kath Artero	1988-06-19	6	Ing. Quimica	Egresado		Entrada por examen de reubicacion	2	192.168.0.96	2015-04-12	2	Ninguno.	F	\N
107	iris.angel@paesis.com	2255-7835	7352-1935	COLONIA SAN MATEO CALLE CARACAS POL "G" CASA # 2  	04160272-7	Iris Angel	1982-05-09	0	Lic. En Mercadeo	Egresado		Entrada por examen de reubicacion	2	192.168.0.97	2015-04-13	2	Ninguno.	F	\N
108	graciela.zepeda@paesis.com	2255-7836	7352-1936	COL. LAS MERCEDEZ PLG. A #11                      	04160273-7	Graciela Zepeda	2000-10-19	4	Lic. En ciencias Juridicas	Estudiante	FLORES VASCONSELOS, CARLOS ROBERTO	 	2	192.168.0.98	2015-04-14	3	Ninguno.	F	\N
109	meybel.ramos@paesis.com	2255-7837	7352-1937	COL. SAN MATEO,KM. 25 1/2 CALLE PRINCIPAL BLOCK H #4, LOURDES, COLÓN.	04160274-5	Meybel Ramos	1986-07-01	0	Ing. Civil	Profesional		Se retiro	2	192.168.0.99	2015-04-15	3	Ninguno.	F	\N
110	freddy.alvarez@paesis.com	2255-7838	7352-1938	URBANIZACION MAJUCLA, POLG.2 C#5 CALLE PRINC.CUS. 	04160275-0	Freddy Alvarez	1997-10-12	3	Lic. En Biologia	Profesional		Reingreso 	2	192.168.0.100	2015-04-16	3	Ninguno.	M	\N
111	marcela.arroyo@paesis.com	2255-7839	7352-1939	RES. ALTO VERDE 2 SENDA LOS LAURELES POL. 7#52    	04160276-4	Marcela Arroyo	1984-03-22	1	Lic. En Mercadeo	Estudiante		Se retiro	2	192.168.0.101	2015-04-17	1	Ninguno.	F	\N
112	evaldivieso@paesis.com	2445-4545	7854-1236	Residecial Escalon Av. Las flores Senda Maya	04452013-3	Enrique Valdivieso	1990-04-19	0	Ing Civil	Universitario	No	TEST	\N	\N	\N	3	TEST	M	\N
\.


--
-- TOC entry 2367 (class 0 OID 0)
-- Dependencies: 198
-- Name: Participantes_CodigoParticipante_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Participantes_CodigoParticipante_seq"', 112, true);


--
-- TOC entry 2300 (class 0 OID 19210)
-- Dependencies: 199
-- Data for Name: Periodos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Periodos" ("CodigoPeriodo", "FechaInicioPeriodo", "FechaFinPeriodo", "Estado", "Comentario", "CodigoModulo") FROM stdin;
3	2016-02-01	2016-02-29	t	test	4
4	2016-02-01	2016-02-07	t	test	4
5	2016-02-08	2016-02-14	t	test	4
7	2016-02-01	2016-02-07	t	test2	5
8	2016-02-01	2016-02-07	t	test2	6
9	2016-02-01	2016-02-07	t	test2	7
10	2016-02-01	2016-02-07	t	test2	8
11	2016-02-01	2016-02-07	t	test2	9
12	2016-02-01	2016-02-07	t	test2	10
13	2016-02-08	2016-02-14	t	test3	10
14	2016-02-08	2016-02-14	t	test3	9
15	2016-02-08	2016-02-14	t	test3	8
16	2016-02-08	2016-02-14	t	test3	7
17	2016-02-08	2016-02-14	t	test3	6
18	2016-02-08	2016-02-14	t	test3	5
19	2016-02-08	2016-02-14	t	test3	4
20	2016-02-02	2016-03-02	t	test 1	4
21	2016-03-01	2016-03-31	t	prueba de modal unificado	7
22	2016-03-01	2016-03-13	t	semana de excel 2016	17
23	2016-03-01	2016-03-31	t	test en dashboardx	19
24	2016-04-01	2016-04-30	t	periodo de abril	18
25	2016-03-01	2016-03-31	t	Grupo Nocturno 1	17
27	2016-04-06	2016-04-30	t	TEST 2	17
28	2016-04-01	2016-05-01	t	TEST 3	17
30	2016-06-01	2016-07-31	t	initial	11
31	2016-07-01	2016-07-31	t	test	93
32	2016-07-01	2016-07-31	t	test	93
33	2016-07-01	2016-07-31	t	test	93
34	2016-07-01	2016-07-31	t	test	94
35	2016-07-01	2016-07-31	t	test	95
36	2016-07-01	2016-07-31	t	test	88
37	2016-07-01	2016-07-31	t	test	88
38	2016-07-01	2016-07-31	t	test	89
39	2016-07-01	2016-07-31	t	test	90
40	2016-07-01	2016-07-31	t	test	91
41	2016-07-01	2016-07-31	t	test	23
42	2016-07-01	2016-07-31	t	test	25
43	2016-07-01	2016-07-31	t	test	27
44	2016-07-01	2016-07-31	t	test	28
45	2016-07-01	2016-07-31	t	test	56
46	2016-07-01	2016-07-31	t	test	57
47	2016-07-01	2016-07-31	t	test	58
48	2016-07-01	2016-07-31	t	test	81
49	2016-07-01	2016-07-31	t	test	82
50	2016-07-01	2016-07-31	t	test	82
51	2016-07-01	2016-07-31	t	test	84
52	2016-07-01	2016-07-31	t	test	66
53	2016-07-01	2016-07-31	t	test	67
54	2016-07-01	2016-07-31	t	test	66
55	2016-07-01	2016-07-31	t	test	69
56	2016-07-01	2016-07-31	t	test	50
57	2016-07-01	2016-07-31	t	test	50
58	2016-07-01	2016-07-31	t	test	50
59	2016-07-01	2016-07-31	t	test	52
60	2016-07-01	2016-07-31	t	test	77
61	2016-07-01	2016-07-31	t	test	78
62	2016-07-01	2016-07-31	t	test	79
63	2016-07-01	2016-07-31	t	test	62
64	2016-07-01	2016-07-31	t	test	63
65	2016-07-01	2016-07-31	t	test	64
66	2016-08-01	2016-08-31	t	test	59
67	2016-08-01	2016-08-31	t	test	59
68	2016-08-01	2016-08-31	t	test	60
69	2016-08-01	2016-08-31	t	test	82
70	2016-08-01	2016-08-31	t	test	83
71	2016-08-01	2016-08-31	t	test	84
72	2016-08-01	2016-08-31	t	test	85
73	2016-08-01	2016-08-30	t	test	86
74	2016-08-01	2016-08-31	t	test	87
75	2016-08-01	2016-08-31	t	test	68
76	2016-08-01	2016-08-31	t	test	69
77	2016-08-01	2016-08-31	t	test	70
78	2016-09-01	2016-09-30	t	test	70
79	2016-09-01	2016-09-30	t	test	71
80	2016-09-01	2016-09-30	t	test	72
81	2016-09-01	2016-09-30	t	test	73
82	2016-09-01	2016-09-30	t	test	74
83	2016-09-01	2016-09-30	t	test	75
84	2016-09-01	2016-09-30	t	test	76
85	2016-09-01	2016-09-30	t	test	53
86	2016-09-01	2016-09-30	t	test	54
87	2016-09-01	2016-09-26	t	test	55
88	2016-09-01	2016-09-26	t	test	80
89	2016-09-01	2016-09-30	t	test	62
90	2016-09-01	2016-09-30	t	test	65
91	2016-08-01	2016-08-31	t	test	34
92	2016-08-01	2016-08-31	t	test	35
93	2016-08-01	2016-08-31	t	test	36
94	2016-09-01	2016-09-30	t	test	37
95	2016-06-01	2016-06-30	t	test	38
96	2016-07-01	2016-07-30	t	test	41
97	2016-08-01	2016-08-30	t	test	42
98	2016-09-01	2016-09-30	t	test	43
99	2016-04-01	2016-04-30	t	test	44
100	2016-05-01	2016-05-30	t	test	45
101	2016-06-01	2016-06-30	t	test	46
102	2016-07-01	2016-07-30	t	test	47
103	2016-08-01	2016-08-30	t	test	48
104	2016-09-01	2016-09-30	t	test	49
105	2016-08-01	2016-08-30	t	TEST	97
106	2016-07-01	2016-07-30	t	asdfasdfaf	93
\.


--
-- TOC entry 2368 (class 0 OID 0)
-- Dependencies: 200
-- Name: Periodos_CodigoPeriodo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Periodos_CodigoPeriodo_seq"', 106, true);


--
-- TOC entry 2302 (class 0 OID 19218)
-- Dependencies: 201
-- Data for Name: Permisos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Permisos" ("CodigoPermisos", "NombrePermiso", "EstadoPermisos", "UsuarioModifica", "IpModifica", "FechaModifica", "idContainer", "classContainer", "controllerContainer", "systemPart", "CodigoPermisoPadre") FROM stdin;
1	Usuarios	t	1	192.168.1.1	2012-12-12	Usuarios	\N	UsuarioController	MenuPpal	\N
2	Diplomados	t	1	192.168.1.1	2012-12-12	Diplomados	\N	DiplomadosController	MenuPpal	\N
3	Publicaciones	t	1	192.168.1.1	2012-08-08	Publicaciones	\N	PublicacionesController	MenuPpal	\N
4	Participantes	t	1	192.168.1.1	2012-08-08	Participantes	\N	ParticipantesController	MenuPpal	\N
5	btnUsuarioNuevo	t	1	192.168.1.1	2015-02-02	divBtnCrudUsr	\N	UsuarioController	\N	\N
6	btnActualizarUsuarios	t	1	192.168.1.1	2015-01-01	divBtnCrudUsr	\N	UsuarioController	\N	\N
7	Roles	t	1	192.168.1.1	2015-01-01	Roles	\N	RolesController	MenuPpal	\N
9	Periodos	t	1	192.168.1.1	2016-03-19	Periodos	\N	GestionGruposController	MenuPpal	\N
10	Modulos	t	1	192.168.1.1	2015-01-01	Modulos	\N	ModulosController	MenuPpal	\N
11	Reportes	t	1	192.168.12.1	2016-06-11	Reportes	\N	ReportesController	MenuPpal	\N
12	btn_modificar_user	t	1	1.1.1.1	2015-01-01	gestionUserBtn		ModulosController		\N
13	btn_eliminar_user	t	1	1.1.1.1	2015-01-01	gestionUserBtn		ModulosController		\N
14	btn_rls_user	t	1	1.1.1.1	2015-01-01	gestionUserBtn		ModulosController		\N
8	Pagos	t	1	192.168.1.1	2015-01-01	Pagos	\N	PagosController	MenuPpal	\N
15	Archivos	t	1	1.1.1.1	2016-01-01	Archivos	\N	ArchivosController	MenuPpal	\N
\.


--
-- TOC entry 2303 (class 0 OID 19224)
-- Dependencies: 202
-- Data for Name: PermisosEventos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "PermisosEventos" ("CodigoPermisosEventos", "NombreEvento", "CodigoPermiso", "TextoEvento") FROM stdin;
\.


--
-- TOC entry 2369 (class 0 OID 0)
-- Dependencies: 203
-- Name: PermisosEventos_CodigoPermisosEventos_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"PermisosEventos_CodigoPermisosEventos_seq"', 1, false);


--
-- TOC entry 2370 (class 0 OID 0)
-- Dependencies: 204
-- Name: Permisos_CodigoPermisos_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Permisos_CodigoPermisos_seq"', 15, true);


--
-- TOC entry 2306 (class 0 OID 19234)
-- Dependencies: 205
-- Data for Name: Publicaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Publicaciones" ("CodigoPublicacion", "UsuarioPublica", "FechaPublicacion", "Titulo", "Contenido", "ParticipantePublica", "Estado", "CodigoGrupoPeriodo", "CodigoGrupoParticipantes", "CodigoGrupoPeriodoUsuario", "CodigoTipoPublicacion", "CodigoCategoriaDiplomado") FROM stdin;
4	1	2016-05-01	Diplomados y Talleres Juridicos	Orientados a todos los profesionales de las leyes interesados en especializarse en algunas ramas como: penal, civil, familiar, etc.	\N	t	\N	\N	\N	1	1
5	1	2016-05-01	Diplomados en Diseño Grafico	Orientados a las carreras informaticas, conoce el amplio mundo del diseño y la publicidad	\N	t	\N	\N	\N	1	2
6	1	2016-05-01	Talleres de Innovacion Regional	Orientados a las carreras que deseen conocer sobre las ultimas innovaciones.	\N	t	\N	\N	\N	1	3
7	1	2016-05-01	Diplomado en Gestion Publica	Orientados a las carreras que deseen conocer sobre las gestion publica y administracion.\n\nEl diplomado comienza a mediados de años y se requiere titulo profesional.	\N	t	\N	\N	\N	1	4
8	1	2016-05-01	Diplomado en Gerencia de Medios.	Orientados a las carreras que deseen conocer sobre las gestion publica y administracion.\n\nEl diplomado comienza a mediados de años y se requiere titulo profesional.	\N	t	\N	\N	\N	1	1
18	1	2016-05-22	you always fell ashame	i will undesrtand	\N	t	\N	\N	\N	1	1
19	1	2016-05-22	jkkklklkflkglkkglfkkkkkk	.lkllkfglkdfkfdlkfdgflgkldg l	\N	t	\N	\N	\N	1	1
20	1	2016-05-22	agua agua 	agua aguaagua aguaagua aguaagua aguaagua aguaagua aguaagua aguaagua aguaagua aguaagua agua\n\nagua aguaagua aguaagua aguaagua aguaagua aguaagua aguaagua aguaagua aguaagua aguaagua aguaagua agua\n\n	\N	t	\N	\N	\N	1	4
\.


--
-- TOC entry 2371 (class 0 OID 0)
-- Dependencies: 206
-- Name: Publicaciones_CodigoPublicacion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Publicaciones_CodigoPublicacion_seq"', 20, true);


--
-- TOC entry 2308 (class 0 OID 19242)
-- Dependencies: 207
-- Data for Name: Rol; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Rol" ("CodigoRol", "NombreRol", "Estado", "VersionRol", "UsuarioModifica", "IPModifica", "FechaModifica") FROM stdin;
1	Administrador	t	1	1	1.1.1.1	\N
2	Secretaria	t	1	1	1.1.1.1	2012-12-12
3	Estudiante	t	1	1	::1	2016-05-01
4	Maestro	t	1	1	::1	2016-05-21
\.


--
-- TOC entry 2372 (class 0 OID 0)
-- Dependencies: 208
-- Name: Rol_CodigoRol_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Rol_CodigoRol_seq"', 4, true);


--
-- TOC entry 2310 (class 0 OID 19250)
-- Dependencies: 209
-- Data for Name: RolesPermisos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "RolesPermisos" ("CodigoRolesPermisos", "Estado", "CodigoPermisos", "CodigoRol") FROM stdin;
1	t	1	1
3	t	3	1
2	t	2	1
4	t	4	1
5	t	5	1
6	t	6	2
7	t	1	2
8	t	2	2
9	t	3	2
10	t	4	2
11	t	7	1
13	t	9	2
14	\N	9	1
15	\N	10	2
16	\N	10	1
17	\N	10	3
18	\N	6	1
19	\N	8	1
20	\N	11	1
21	\N	12	1
22	\N	13	1
23	\N	14	1
24	\N	15	1
\.


--
-- TOC entry 2373 (class 0 OID 0)
-- Dependencies: 210
-- Name: RolesPermisos_CodigoRolesPermisos_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"RolesPermisos_CodigoRolesPermisos_seq"', 24, true);


--
-- TOC entry 2312 (class 0 OID 19255)
-- Dependencies: 211
-- Data for Name: Tema; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Tema" ("idTema", "Nombre", path) FROM stdin;
1	default	/css/bootstrap.min.js
\.


--
-- TOC entry 2374 (class 0 OID 0)
-- Dependencies: 212
-- Name: Tema_idTema_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Tema_idTema_seq"', 1, true);


--
-- TOC entry 2314 (class 0 OID 19263)
-- Dependencies: 213
-- Data for Name: TiposPublicacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "TiposPublicacion" ("CodigoTiposPublicacion", "NombrePublicacion") FROM stdin;
1	publicacion web
\.


--
-- TOC entry 2375 (class 0 OID 0)
-- Dependencies: 214
-- Name: TiposPublicacion_CodigoTiposPublicacion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"TiposPublicacion_CodigoTiposPublicacion_seq"', 1, false);


--
-- TOC entry 2316 (class 0 OID 19268)
-- Dependencies: 215
-- Data for Name: Turnos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Turnos" ("CodigoTurno", "NombreTurno", "HoraInicio", "HoraFin", "UsuarioModifica", "IpModifica", "FechaModifica", "Estado", "Comentarios") FROM stdin;
1	Matutino	06:00:00-06	12:00:00-06	\N	\N	\N	t	test1
\.


--
-- TOC entry 2376 (class 0 OID 0)
-- Dependencies: 216
-- Name: Turnos_CodigoTurno_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Turnos_CodigoTurno_seq"', 1, true);


--
-- TOC entry 2318 (class 0 OID 19276)
-- Dependencies: 217
-- Data for Name: UsuarioRoles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "UsuarioRoles" ("CodigoUsuarioRoles", "CodigoRol", "CodigoUsuario") FROM stdin;
1	1	1
4	1	29
5	1	28
7	3	27
6	1	2
8	4	65
9	4	1
10	4	2
11	4	26
\.


--
-- TOC entry 2377 (class 0 OID 0)
-- Dependencies: 218
-- Name: UsuarioRoles_CodigoUsuarioRoles_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"UsuarioRoles_CodigoUsuarioRoles_seq"', 11, true);


--
-- TOC entry 2320 (class 0 OID 19281)
-- Dependencies: 219
-- Data for Name: Usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Usuarios" ("CodigoUsuario", "NombreUsuario", "ContraseniaUsuario", "CorreoUsuario", "Nombre", "UsuarioModifica", "IPModifica", "FechaModifica", "Comentarios", "idTema") FROM stdin;
2	Maynor	maynor	maynorLopez@gmail.com	Maynor Gabriel Lopez Jimenez                                                                                                                                                                            	1	192.168.1.12	2015-08-05	\N	1
26	joha	ksdfjkl	sdf@kdjfk.com	johanna                                                                                                                                                                                                 	\N	\N	2015-11-15	klsdfjlkjsdfkjkj	1
1	Luis	123	luisarrabi@gmail.sv	Luis Armando Ibarra Bonilla                                                                                                                                                                             	\N	\N	2015-11-15		1
28	armando ibarra bonilla 	aaa	a@a	luis                                                                                                                                                                                                    	1	127.0.0.1	2015-12-25	s	1
29	a	123	aaa@asd	l                                                                                                                                                                                                       	1	127.0.0.1	2015-12-26	2	1
27	joh	123456	joh@nose	joh                                                                                                                                                                                                     	1	::1	2016-05-27	12345	1
65	dfigueroa	1234	figueroa.diana@gmail.com	diana figueroa                                                                                                                                                                                          	2	::1	2016-07-24	test	1
\.


--
-- TOC entry 2378 (class 0 OID 0)
-- Dependencies: 220
-- Name: Usuarios_CodigoUsuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Usuarios_CodigoUsuario_seq"', 65, true);


--
-- TOC entry 2078 (class 2606 OID 19315)
-- Name: PKCodigoCategoriaParticipantes; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "CategoriasParticipante"
    ADD CONSTRAINT "PKCodigoCategoriaParticipantes" PRIMARY KEY ("CodigoCategoriaParticipantes");


--
-- TOC entry 2092 (class 2606 OID 19317)
-- Name: PKCodigoGruposPeriodoUsuario; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "GruposMaestros"
    ADD CONSTRAINT "PKCodigoGruposPeriodoUsuario" PRIMARY KEY ("CodigoGruposPeriodoUsuario");


--
-- TOC entry 2110 (class 2606 OID 19319)
-- Name: PKCodigoPeriodo; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Periodos"
    ADD CONSTRAINT "PKCodigoPeriodo" PRIMARY KEY ("CodigoPeriodo");


--
-- TOC entry 2117 (class 2606 OID 19321)
-- Name: PKCodigoPublicacion; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Publicaciones"
    ADD CONSTRAINT "PKCodigoPublicacion" PRIMARY KEY ("CodigoPublicacion");


--
-- TOC entry 2087 (class 2606 OID 19323)
-- Name: PKEstadosParticipacion; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "EstadosParticipantes"
    ADD CONSTRAINT "PKEstadosParticipacion" PRIMARY KEY ("CodigoEstados");


--
-- TOC entry 2107 (class 2606 OID 19325)
-- Name: PKParticipantes; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Participantes"
    ADD CONSTRAINT "PKParticipantes" PRIMARY KEY ("CodigoParticipante");


--
-- TOC entry 2122 (class 2606 OID 19327)
-- Name: PKRol; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Rol"
    ADD CONSTRAINT "PKRol" PRIMARY KEY ("CodigoRol");


--
-- TOC entry 2137 (class 2606 OID 19329)
-- Name: PKUsuario; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Usuarios"
    ADD CONSTRAINT "PKUsuario" PRIMARY KEY ("CodigoUsuario");


--
-- TOC entry 2133 (class 2606 OID 19331)
-- Name: PKUsuariosRoles; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "UsuarioRoles"
    ADD CONSTRAINT "PKUsuariosRoles" PRIMARY KEY ("CodigoUsuarioRoles");


--
-- TOC entry 2115 (class 2606 OID 19333)
-- Name: PK_Eventos_Permiso; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "PermisosEventos"
    ADD CONSTRAINT "PK_Eventos_Permiso" PRIMARY KEY ("CodigoPermisosEventos");


--
-- TOC entry 2076 (class 2606 OID 19335)
-- Name: pkCategoriaDiplomados; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "CategoriaDiplomados"
    ADD CONSTRAINT "pkCategoriaDiplomados" PRIMARY KEY ("CodigoCategoriaDiplomado");


--
-- TOC entry 2072 (class 2606 OID 19337)
-- Name: pkCodigoArchivo; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Archivos"
    ADD CONSTRAINT "pkCodigoArchivo" PRIMARY KEY ("CodigoArchivos");


--
-- TOC entry 2080 (class 2606 OID 19339)
-- Name: pkComentarios; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Comentarios"
    ADD CONSTRAINT "pkComentarios" PRIMARY KEY ("CodigoComentarios");


--
-- TOC entry 2082 (class 2606 OID 19341)
-- Name: pkConstantes; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Constantes"
    ADD CONSTRAINT "pkConstantes" PRIMARY KEY ("CodigoConstante");


--
-- TOC entry 2085 (class 2606 OID 19343)
-- Name: pkDiplomados; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Diplomados"
    ADD CONSTRAINT "pkDiplomados" PRIMARY KEY ("CodigoDiplomado");


--
-- TOC entry 2105 (class 2606 OID 19345)
-- Name: pkModulos; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Modulos"
    ADD CONSTRAINT "pkModulos" PRIMARY KEY ("CodigoModulo");


--
-- TOC entry 2113 (class 2606 OID 19347)
-- Name: pkPermisos; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Permisos"
    ADD CONSTRAINT "pkPermisos" PRIMARY KEY ("CodigoPermisos");


--
-- TOC entry 2125 (class 2606 OID 19349)
-- Name: pkRolesPermisos; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "RolesPermisos"
    ADD CONSTRAINT "pkRolesPermisos" PRIMARY KEY ("CodigoRolesPermisos");


--
-- TOC entry 2129 (class 2606 OID 19351)
-- Name: pkTiposPublicacion; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "TiposPublicacion"
    ADD CONSTRAINT "pkTiposPublicacion" PRIMARY KEY ("CodigoTiposPublicacion");


--
-- TOC entry 2131 (class 2606 OID 19353)
-- Name: pkTurnos; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Turnos"
    ADD CONSTRAINT "pkTurnos" PRIMARY KEY ("CodigoTurno");


--
-- TOC entry 2074 (class 2606 OID 19355)
-- Name: pk_Auditoria; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Auditoria"
    ADD CONSTRAINT "pk_Auditoria" PRIMARY KEY ("CodigoAuditoria");


--
-- TOC entry 2100 (class 2606 OID 19357)
-- Name: pk_GrupoParticipantes; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "GruposParticipantes"
    ADD CONSTRAINT "pk_GrupoParticipantes" PRIMARY KEY ("CodigoGruposParticipantes");


--
-- TOC entry 2090 (class 2606 OID 19359)
-- Name: pk_GrupoPeriodo; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "GrupoPeriodos"
    ADD CONSTRAINT "pk_GrupoPeriodo" PRIMARY KEY ("CodigoGrupoPeriodo");


--
-- TOC entry 2127 (class 2606 OID 19361)
-- Name: pk_Tema; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Tema"
    ADD CONSTRAINT "pk_Tema" PRIMARY KEY ("idTema");


--
-- TOC entry 2108 (class 1259 OID 19362)
-- Name: fki_CategoriaParticipante; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_CategoriaParticipante" ON "Participantes" USING btree ("CodigoCategoriaParticipantes");


--
-- TOC entry 2083 (class 1259 OID 19363)
-- Name: fki_CaterogiaDiplomados; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_CaterogiaDiplomados" ON "Diplomados" USING btree ("CodigoCategoriaDiplomado");


--
-- TOC entry 2101 (class 1259 OID 19364)
-- Name: fki_Diplomado; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_Diplomado" ON "Modulos" USING btree ("CodigoDiplomado");


--
-- TOC entry 2095 (class 1259 OID 19365)
-- Name: fki_EstadosParticipantes; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_EstadosParticipantes" ON "GruposParticipantes" USING btree ("CodigoEstadosParticipacion");


--
-- TOC entry 2118 (class 1259 OID 19366)
-- Name: fki_GrupoParticipantesP; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_GrupoParticipantesP" ON "Publicaciones" USING btree ("CodigoGrupoParticipantes");


--
-- TOC entry 2096 (class 1259 OID 19367)
-- Name: fki_GrupoPeriodo; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_GrupoPeriodo" ON "GruposParticipantes" USING btree ("CodigoGrupoPeriodo");


--
-- TOC entry 2093 (class 1259 OID 19368)
-- Name: fki_GrupoPeriodoGPU; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_GrupoPeriodoGPU" ON "GruposMaestros" USING btree ("CodigoGrupoPeriodo");


--
-- TOC entry 2119 (class 1259 OID 19369)
-- Name: fki_GrupoPeriodoP; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_GrupoPeriodoP" ON "Publicaciones" USING btree ("CodigoGrupoPeriodo");


--
-- TOC entry 2120 (class 1259 OID 19370)
-- Name: fki_GrupoPeriodoUsuarioP; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_GrupoPeriodoUsuarioP" ON "Publicaciones" USING btree ("CodigoGrupoPeriodoUsuario");


--
-- TOC entry 2102 (class 1259 OID 19371)
-- Name: fki_ModuloModulo; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_ModuloModulo" ON "Modulos" USING btree ("CodigoModulo");


--
-- TOC entry 2111 (class 1259 OID 19372)
-- Name: fki_Modulos; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_Modulos" ON "Periodos" USING btree ("CodigoModulo");


--
-- TOC entry 2097 (class 1259 OID 19373)
-- Name: fki_Participantes; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_Participantes" ON "GruposParticipantes" USING btree ("CodigoParticipante");


--
-- TOC entry 2088 (class 1259 OID 19374)
-- Name: fki_Periodo; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_Periodo" ON "GrupoPeriodos" USING btree ("CodigoPeriodo");


--
-- TOC entry 2123 (class 1259 OID 19375)
-- Name: fki_Permisos; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_Permisos" ON "RolesPermisos" USING btree ("CodigoPermisos");


--
-- TOC entry 2070 (class 1259 OID 19376)
-- Name: fki_PublicacionesA; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_PublicacionesA" ON "Archivos" USING btree ("CodigoPublicaciones");


--
-- TOC entry 2134 (class 1259 OID 19377)
-- Name: fki_Rol; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_Rol" ON "UsuarioRoles" USING btree ("CodigoRol");


--
-- TOC entry 2103 (class 1259 OID 19378)
-- Name: fki_Turno; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_Turno" ON "Modulos" USING btree ("CodigoTurno");


--
-- TOC entry 2135 (class 1259 OID 19379)
-- Name: fki_Usuario; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_Usuario" ON "UsuarioRoles" USING btree ("CodigoUsuario");


--
-- TOC entry 2094 (class 1259 OID 19380)
-- Name: fki_UsuarioGPU; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_UsuarioGPU" ON "GruposMaestros" USING btree ("CodigoUsuario");


--
-- TOC entry 2138 (class 1259 OID 19381)
-- Name: fki_Usuario_Tema; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_Usuario_Tema" ON "Usuarios" USING btree ("idTema");


--
-- TOC entry 2098 (class 1259 OID 19382)
-- Name: fki_Usuarios; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_Usuarios" ON "GruposParticipantes" USING btree ("CodigoUsuario");


--
-- TOC entry 2154 (class 2606 OID 19383)
-- Name: FK_Permiso_Evento; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "PermisosEventos"
    ADD CONSTRAINT "FK_Permiso_Evento" FOREIGN KEY ("CodigoPermiso") REFERENCES "Permisos"("CodigoPermisos");


--
-- TOC entry 2140 (class 2606 OID 19388)
-- Name: Fk_Publicaciones_Comentarios; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Comentarios"
    ADD CONSTRAINT "Fk_Publicaciones_Comentarios" FOREIGN KEY ("CodigoPublicaciones") REFERENCES "Publicaciones"("CodigoPublicacion");


--
-- TOC entry 2153 (class 2606 OID 19393)
-- Name: fkPermisoPadre; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Permisos"
    ADD CONSTRAINT "fkPermisoPadre" FOREIGN KEY ("CodigoPermisoPadre") REFERENCES "Permisos"("CodigoPermisos");


--
-- TOC entry 2151 (class 2606 OID 19398)
-- Name: fk_CategoriaParticipante; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Participantes"
    ADD CONSTRAINT "fk_CategoriaParticipante" FOREIGN KEY ("CodigoCategoriaParticipantes") REFERENCES "CategoriasParticipante"("CodigoCategoriaParticipantes");


--
-- TOC entry 2141 (class 2606 OID 19403)
-- Name: fk_CaterogiaDiplomados; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Diplomados"
    ADD CONSTRAINT "fk_CaterogiaDiplomados" FOREIGN KEY ("CodigoCategoriaDiplomado") REFERENCES "CategoriaDiplomados"("CodigoCategoriaDiplomado");


--
-- TOC entry 2155 (class 2606 OID 19408)
-- Name: fk_CodigoCategoriaDiplomado; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Publicaciones"
    ADD CONSTRAINT "fk_CodigoCategoriaDiplomado" FOREIGN KEY ("CodigoCategoriaDiplomado") REFERENCES "CategoriaDiplomados"("CodigoCategoriaDiplomado");


--
-- TOC entry 2149 (class 2606 OID 19413)
-- Name: fk_Diplomado; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Modulos"
    ADD CONSTRAINT "fk_Diplomado" FOREIGN KEY ("CodigoDiplomado") REFERENCES "Diplomados"("CodigoDiplomado");


--
-- TOC entry 2145 (class 2606 OID 19418)
-- Name: fk_EstadosParticipantes; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "GruposParticipantes"
    ADD CONSTRAINT "fk_EstadosParticipantes" FOREIGN KEY ("CodigoEstadosParticipacion") REFERENCES "EstadosParticipantes"("CodigoEstados");


--
-- TOC entry 2156 (class 2606 OID 19423)
-- Name: fk_GrupoParticipantesP; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Publicaciones"
    ADD CONSTRAINT "fk_GrupoParticipantesP" FOREIGN KEY ("CodigoGrupoParticipantes") REFERENCES "GruposParticipantes"("CodigoGruposParticipantes");


--
-- TOC entry 2146 (class 2606 OID 19428)
-- Name: fk_GrupoPeriodo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "GruposParticipantes"
    ADD CONSTRAINT "fk_GrupoPeriodo" FOREIGN KEY ("CodigoGrupoPeriodo") REFERENCES "GrupoPeriodos"("CodigoGrupoPeriodo");


--
-- TOC entry 2143 (class 2606 OID 19433)
-- Name: fk_GrupoPeriodoGPU; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "GruposMaestros"
    ADD CONSTRAINT "fk_GrupoPeriodoGPU" FOREIGN KEY ("CodigoGrupoPeriodo") REFERENCES "GrupoPeriodos"("CodigoGrupoPeriodo");


--
-- TOC entry 2157 (class 2606 OID 19438)
-- Name: fk_GrupoPeriodoP; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Publicaciones"
    ADD CONSTRAINT "fk_GrupoPeriodoP" FOREIGN KEY ("CodigoGrupoPeriodo") REFERENCES "GrupoPeriodos"("CodigoGrupoPeriodo");


--
-- TOC entry 2158 (class 2606 OID 19443)
-- Name: fk_GrupoPeriodoUsuarioP; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Publicaciones"
    ADD CONSTRAINT "fk_GrupoPeriodoUsuarioP" FOREIGN KEY ("CodigoGrupoPeriodoUsuario") REFERENCES "GruposMaestros"("CodigoGruposPeriodoUsuario");


--
-- TOC entry 2152 (class 2606 OID 19448)
-- Name: fk_Modulos; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Periodos"
    ADD CONSTRAINT "fk_Modulos" FOREIGN KEY ("CodigoModulo") REFERENCES "Modulos"("CodigoModulo");


--
-- TOC entry 2147 (class 2606 OID 19453)
-- Name: fk_Participantes; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "GruposParticipantes"
    ADD CONSTRAINT "fk_Participantes" FOREIGN KEY ("CodigoParticipante") REFERENCES "Participantes"("CodigoParticipante");


--
-- TOC entry 2142 (class 2606 OID 19458)
-- Name: fk_Periodo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "GrupoPeriodos"
    ADD CONSTRAINT "fk_Periodo" FOREIGN KEY ("CodigoPeriodo") REFERENCES "Periodos"("CodigoPeriodo");


--
-- TOC entry 2160 (class 2606 OID 19463)
-- Name: fk_Permisos; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "RolesPermisos"
    ADD CONSTRAINT "fk_Permisos" FOREIGN KEY ("CodigoPermisos") REFERENCES "Permisos"("CodigoPermisos");


--
-- TOC entry 2139 (class 2606 OID 19468)
-- Name: fk_PublicacionesA; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Archivos"
    ADD CONSTRAINT "fk_PublicacionesA" FOREIGN KEY ("CodigoPublicaciones") REFERENCES "Publicaciones"("CodigoPublicacion");


--
-- TOC entry 2159 (class 2606 OID 19473)
-- Name: fk_Publilcacion_TipoPublicacion; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Publicaciones"
    ADD CONSTRAINT "fk_Publilcacion_TipoPublicacion" FOREIGN KEY ("CodigoTipoPublicacion") REFERENCES "TiposPublicacion"("CodigoTiposPublicacion");


--
-- TOC entry 2162 (class 2606 OID 19478)
-- Name: fk_Rol; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "UsuarioRoles"
    ADD CONSTRAINT "fk_Rol" FOREIGN KEY ("CodigoRol") REFERENCES "Rol"("CodigoRol");


--
-- TOC entry 2150 (class 2606 OID 19483)
-- Name: fk_Turno; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Modulos"
    ADD CONSTRAINT "fk_Turno" FOREIGN KEY ("CodigoTurno") REFERENCES "Turnos"("CodigoTurno");


--
-- TOC entry 2163 (class 2606 OID 19488)
-- Name: fk_Usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "UsuarioRoles"
    ADD CONSTRAINT "fk_Usuario" FOREIGN KEY ("CodigoUsuario") REFERENCES "Usuarios"("CodigoUsuario");


--
-- TOC entry 2144 (class 2606 OID 19493)
-- Name: fk_UsuarioGPU; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "GruposMaestros"
    ADD CONSTRAINT "fk_UsuarioGPU" FOREIGN KEY ("CodigoUsuario") REFERENCES "Usuarios"("CodigoUsuario");


--
-- TOC entry 2164 (class 2606 OID 19498)
-- Name: fk_Usuario_Tema; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Usuarios"
    ADD CONSTRAINT "fk_Usuario_Tema" FOREIGN KEY ("idTema") REFERENCES "Tema"("idTema");


--
-- TOC entry 2148 (class 2606 OID 19503)
-- Name: fk_Usuarios; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "GruposParticipantes"
    ADD CONSTRAINT "fk_Usuarios" FOREIGN KEY ("CodigoUsuario") REFERENCES "Usuarios"("CodigoUsuario");


--
-- TOC entry 2161 (class 2606 OID 19508)
-- Name: fk_roles; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "RolesPermisos"
    ADD CONSTRAINT fk_roles FOREIGN KEY ("CodigoRol") REFERENCES "Rol"("CodigoRol");


--
-- TOC entry 2328 (class 0 OID 0)
-- Dependencies: 7
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2016-07-29 22:14:13

--
-- PostgreSQL database dump complete
--

