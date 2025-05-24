--
-- PostgreSQL database dump
--

-- Dumped from database version 16.8 (Debian 16.8-1.pgdg120+1)
-- Dumped by pg_dump version 17.5

-- Started on 2025-05-22 12:12:38

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 5 (class 2615 OID 16488)
-- Name: public; Type: SCHEMA; Schema: -; Owner: prueba_db_n963_user
--

-- *not* creating schema, since initdb creates it


ALTER SCHEMA public OWNER TO prueba_db_n963_user;

--
-- TOC entry 3472 (class 0 OID 0)
-- Dependencies: 5
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: prueba_db_n963_user
--

COMMENT ON SCHEMA public IS '';


--
-- TOC entry 230 (class 1255 OID 16691)
-- Name: actualizar_updated_at(); Type: FUNCTION; Schema: public; Owner: prueba_db_n963_user
--

CREATE FUNCTION public.actualizar_updated_at() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
  NEW.updated_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$;


ALTER FUNCTION public.actualizar_updated_at() OWNER TO prueba_db_n963_user;

--
-- TOC entry 231 (class 1255 OID 16697)
-- Name: descontar_stock(); Type: FUNCTION; Schema: public; Owner: prueba_db_n963_user
--

CREATE FUNCTION public.descontar_stock() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
  UPDATE productos
  SET stock = stock - NEW.cantidad
  WHERE id = NEW.id_producto;
  RETURN NEW;
END;
$$;


ALTER FUNCTION public.descontar_stock() OWNER TO prueba_db_n963_user;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 216 (class 1259 OID 16540)
-- Name: categorias; Type: TABLE; Schema: public; Owner: prueba_db_n963_user
--

CREATE TABLE public.categorias (
    id integer NOT NULL,
    categoria character varying(100) NOT NULL
);


ALTER TABLE public.categorias OWNER TO prueba_db_n963_user;

--
-- TOC entry 215 (class 1259 OID 16539)
-- Name: categorias_id_seq; Type: SEQUENCE; Schema: public; Owner: prueba_db_n963_user
--

CREATE SEQUENCE public.categorias_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categorias_id_seq OWNER TO prueba_db_n963_user;

--
-- TOC entry 3474 (class 0 OID 0)
-- Dependencies: 215
-- Name: categorias_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prueba_db_n963_user
--

ALTER SEQUENCE public.categorias_id_seq OWNED BY public.categorias.id;


--
-- TOC entry 229 (class 1259 OID 16659)
-- Name: detalle_productos; Type: TABLE; Schema: public; Owner: prueba_db_n963_user
--

CREATE TABLE public.detalle_productos (
    id_producto integer NOT NULL,
    color character varying(50) DEFAULT NULL::character varying,
    memoria_ram character varying(50) DEFAULT NULL::character varying,
    almacenamiento character varying(50) DEFAULT NULL::character varying,
    pantalla character varying(50) DEFAULT NULL::character varying,
    tipo_carga character varying(50) DEFAULT NULL::character varying,
    dimensiones character varying(100) DEFAULT NULL::character varying,
    peso character varying(50) DEFAULT NULL::character varying,
    material character varying(50) DEFAULT NULL::character varying,
    descripcion text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.detalle_productos OWNER TO prueba_db_n963_user;

--
-- TOC entry 228 (class 1259 OID 16643)
-- Name: detalle_ventas; Type: TABLE; Schema: public; Owner: prueba_db_n963_user
--

CREATE TABLE public.detalle_ventas (
    id_venta integer NOT NULL,
    id_productos integer NOT NULL,
    cantidad integer,
    CONSTRAINT detalle_ventas_chk_1 CHECK ((cantidad >= 1))
);


ALTER TABLE public.detalle_ventas OWNER TO prueba_db_n963_user;

--
-- TOC entry 218 (class 1259 OID 16562)
-- Name: metodo_pagos; Type: TABLE; Schema: public; Owner: prueba_db_n963_user
--

CREATE TABLE public.metodo_pagos (
    id integer NOT NULL,
    metodo_pago character varying(100) NOT NULL
);


ALTER TABLE public.metodo_pagos OWNER TO prueba_db_n963_user;

--
-- TOC entry 217 (class 1259 OID 16561)
-- Name: metodo_pagos_id_seq; Type: SEQUENCE; Schema: public; Owner: prueba_db_n963_user
--

CREATE SEQUENCE public.metodo_pagos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.metodo_pagos_id_seq OWNER TO prueba_db_n963_user;

--
-- TOC entry 3475 (class 0 OID 0)
-- Dependencies: 217
-- Name: metodo_pagos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prueba_db_n963_user
--

ALTER SEQUENCE public.metodo_pagos_id_seq OWNED BY public.metodo_pagos.id;


--
-- TOC entry 220 (class 1259 OID 16569)
-- Name: personas; Type: TABLE; Schema: public; Owner: prueba_db_n963_user
--

CREATE TABLE public.personas (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    apellido character varying(100) NOT NULL,
    fecha_nacimiento date,
    telefono character varying(20) DEFAULT NULL::character varying,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.personas OWNER TO prueba_db_n963_user;

--
-- TOC entry 219 (class 1259 OID 16568)
-- Name: personas_id_seq; Type: SEQUENCE; Schema: public; Owner: prueba_db_n963_user
--

CREATE SEQUENCE public.personas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.personas_id_seq OWNER TO prueba_db_n963_user;

--
-- TOC entry 3476 (class 0 OID 0)
-- Dependencies: 219
-- Name: personas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prueba_db_n963_user
--

ALTER SEQUENCE public.personas_id_seq OWNED BY public.personas.id;


--
-- TOC entry 227 (class 1259 OID 16629)
-- Name: productos; Type: TABLE; Schema: public; Owner: prueba_db_n963_user
--

CREATE TABLE public.productos (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    precio numeric(20,2) NOT NULL,
    id_categoria integer,
    imagen character varying(255) DEFAULT NULL::character varying,
    stock integer,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT productos_chk_1 CHECK ((precio > (0)::numeric)),
    CONSTRAINT productos_chk_2 CHECK ((stock >= 0))
);


ALTER TABLE public.productos OWNER TO prueba_db_n963_user;

--
-- TOC entry 226 (class 1259 OID 16628)
-- Name: productos_id_seq; Type: SEQUENCE; Schema: public; Owner: prueba_db_n963_user
--

CREATE SEQUENCE public.productos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.productos_id_seq OWNER TO prueba_db_n963_user;

--
-- TOC entry 3477 (class 0 OID 0)
-- Dependencies: 226
-- Name: productos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prueba_db_n963_user
--

ALTER SEQUENCE public.productos_id_seq OWNED BY public.productos.id;


--
-- TOC entry 222 (class 1259 OID 16577)
-- Name: rol_usuarios; Type: TABLE; Schema: public; Owner: prueba_db_n963_user
--

CREATE TABLE public.rol_usuarios (
    id integer NOT NULL,
    rol character varying(50) NOT NULL
);


ALTER TABLE public.rol_usuarios OWNER TO prueba_db_n963_user;

--
-- TOC entry 221 (class 1259 OID 16576)
-- Name: rol_usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: prueba_db_n963_user
--

CREATE SEQUENCE public.rol_usuarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.rol_usuarios_id_seq OWNER TO prueba_db_n963_user;

--
-- TOC entry 3478 (class 0 OID 0)
-- Dependencies: 221
-- Name: rol_usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prueba_db_n963_user
--

ALTER SEQUENCE public.rol_usuarios_id_seq OWNED BY public.rol_usuarios.id;


--
-- TOC entry 225 (class 1259 OID 16600)
-- Name: usuarios; Type: TABLE; Schema: public; Owner: prueba_db_n963_user
--

CREATE TABLE public.usuarios (
    id_personas integer NOT NULL,
    correo character varying(100) NOT NULL,
    "contraseña" character varying(255) NOT NULL,
    id_rol integer,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.usuarios OWNER TO prueba_db_n963_user;

--
-- TOC entry 224 (class 1259 OID 16584)
-- Name: ventas; Type: TABLE; Schema: public; Owner: prueba_db_n963_user
--

CREATE TABLE public.ventas (
    id integer NOT NULL,
    id_personas integer,
    id_metodo_pago integer,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.ventas OWNER TO prueba_db_n963_user;

--
-- TOC entry 223 (class 1259 OID 16583)
-- Name: ventas_id_seq; Type: SEQUENCE; Schema: public; Owner: prueba_db_n963_user
--

CREATE SEQUENCE public.ventas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.ventas_id_seq OWNER TO prueba_db_n963_user;

--
-- TOC entry 3479 (class 0 OID 0)
-- Dependencies: 223
-- Name: ventas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prueba_db_n963_user
--

ALTER SEQUENCE public.ventas_id_seq OWNED BY public.ventas.id;


--
-- TOC entry 3246 (class 2604 OID 16543)
-- Name: categorias id; Type: DEFAULT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.categorias ALTER COLUMN id SET DEFAULT nextval('public.categorias_id_seq'::regclass);


--
-- TOC entry 3247 (class 2604 OID 16565)
-- Name: metodo_pagos id; Type: DEFAULT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.metodo_pagos ALTER COLUMN id SET DEFAULT nextval('public.metodo_pagos_id_seq'::regclass);


--
-- TOC entry 3248 (class 2604 OID 16572)
-- Name: personas id; Type: DEFAULT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.personas ALTER COLUMN id SET DEFAULT nextval('public.personas_id_seq'::regclass);


--
-- TOC entry 3258 (class 2604 OID 16632)
-- Name: productos id; Type: DEFAULT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.productos ALTER COLUMN id SET DEFAULT nextval('public.productos_id_seq'::regclass);


--
-- TOC entry 3252 (class 2604 OID 16580)
-- Name: rol_usuarios id; Type: DEFAULT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.rol_usuarios ALTER COLUMN id SET DEFAULT nextval('public.rol_usuarios_id_seq'::regclass);


--
-- TOC entry 3253 (class 2604 OID 16587)
-- Name: ventas id; Type: DEFAULT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.ventas ALTER COLUMN id SET DEFAULT nextval('public.ventas_id_seq'::regclass);


--
-- TOC entry 3453 (class 0 OID 16540)
-- Dependencies: 216
-- Data for Name: categorias; Type: TABLE DATA; Schema: public; Owner: prueba_db_n963_user
--

INSERT INTO public.categorias VALUES (1, 'Laptops');
INSERT INTO public.categorias VALUES (2, 'Smartphones');
INSERT INTO public.categorias VALUES (3, 'Accesorios');
INSERT INTO public.categorias VALUES (4, 'Gaming');


--
-- TOC entry 3466 (class 0 OID 16659)
-- Dependencies: 229
-- Data for Name: detalle_productos; Type: TABLE DATA; Schema: public; Owner: prueba_db_n963_user
--

INSERT INTO public.detalle_productos VALUES (1, 'Plata', '16GB', '512GB SSD', '13.4\" FHD+', 'USB-C', '30.2 x 1.5 cm', '1.2kg', 'Aluminio', 'Ultrabook con pantalla InfinityEdge de 13.4\", Intel i7, 16GB RAM, 512GB SSD.', '2025-05-20 23:06:07.935499', '2025-05-20 23:06:07.935499');
INSERT INTO public.detalle_productos VALUES (2, 'Gris espacial', '8GB', '256GB SSD', '13.6\" Retina', 'USB-C', '30.4 x 1.1 cm', '1.24kg', 'Aluminio', 'Laptop Apple de 13.6\", chip M2, 8GB RAM, 256GB SSD.', '2025-05-20 23:06:07.935499', '2025-05-20 23:06:07.935499');
INSERT INTO public.detalle_productos VALUES (3, 'Negro', '6GB', '128GB', '6.1\" OLED', 'Lightning', '14.7 x 7.1 x 0.8 cm', '172g', 'Vidrio y aluminio', 'Smartphone Apple de 6.1\", A16 Bionic, cámara avanzada de 48 MP.', '2025-05-20 23:06:07.935499', '2025-05-20 23:06:07.935499');
INSERT INTO public.detalle_productos VALUES (4, 'Titanium Black', '8GB', '256GB', '6.2\" AMOLED', 'USB-C', '14.8 x 7.2 x 0.9 cm', '180g', 'Metal y vidrio', 'Android 6.2\", Snapdragon 8 Gen 3, cámara triple de 50MP.', '2025-05-20 23:06:07.935499', '2025-05-20 23:06:07.935499');
INSERT INTO public.detalle_productos VALUES (5, 'Grafito', 'Sin RAM', 'Interna', 'Sin pantalla', 'USB-C', '12.5 x 8.4 x 5.1 cm', '141g', 'Plástico Premium', 'Mouse inalámbrico con sensor de alta precisión y múltiples botones programables.', '2025-05-20 23:06:07.935499', '2025-05-20 23:06:07.935499');
INSERT INTO public.detalle_productos VALUES (6, 'Negro', 'Sin RAM', '65W salida', 'Sin pantalla', 'USB-C', '6.2 x 4.5 x 2.5 cm', '115g', 'Plástico resistente', 'Cargador compacto con tecnología GaN para carga rápida.', '2025-05-20 23:06:07.935499', '2025-05-20 23:06:07.935499');
INSERT INTO public.detalle_productos VALUES (7, 'Blanco', '16GB GDDR6', '1TB SSD', 'Salida HDMI 4K HDR', 'Cable AC', '39 x 10.4 x 26 cm', '4.5kg', 'Plástico', 'Consola de videojuegos con carga ultra rápida y soporte para 4K HDR.', '2025-05-20 23:06:07.935499', '2025-05-20 23:06:07.935499');
INSERT INTO public.detalle_productos VALUES (8, 'Negro', 'Compatible PC/PS5', 'Cableado', 'Sin pantalla', 'USB + Jack 3.5mm', '21 x 19 x 10 cm', '240g', 'Plástico', 'Auriculares con sonido envolvente 7.1, micrófono desmontable y diadema acolchada.', '2025-05-20 23:06:07.935499', '2025-05-20 23:06:07.935499');


--
-- TOC entry 3465 (class 0 OID 16643)
-- Dependencies: 228
-- Data for Name: detalle_ventas; Type: TABLE DATA; Schema: public; Owner: prueba_db_n963_user
--



--
-- TOC entry 3455 (class 0 OID 16562)
-- Dependencies: 218
-- Data for Name: metodo_pagos; Type: TABLE DATA; Schema: public; Owner: prueba_db_n963_user
--

INSERT INTO public.metodo_pagos VALUES (1, 'Efectivo');
INSERT INTO public.metodo_pagos VALUES (2, 'Tarjeta de Crédito');
INSERT INTO public.metodo_pagos VALUES (3, 'Tarjeta de Débito');
INSERT INTO public.metodo_pagos VALUES (4, 'Transferencia Bancaria');
INSERT INTO public.metodo_pagos VALUES (5, 'Billetera Virtual');


--
-- TOC entry 3457 (class 0 OID 16569)
-- Dependencies: 220
-- Data for Name: personas; Type: TABLE DATA; Schema: public; Owner: prueba_db_n963_user
--

INSERT INTO public.personas VALUES (1, 'Gustavo', 'Gines', '1996-03-28', '370-4787285', '2025-05-20 23:06:03.969434', '2025-05-20 23:06:03.969434');
INSERT INTO public.personas VALUES (2, 'Santiago', 'Gines', '2000-04-03', '3704366457', '2025-05-20 23:06:03.969434', '2025-05-20 23:06:03.969434');
INSERT INTO public.personas VALUES (3, 'Gerardo', '', '1983-10-31', '03704857048', '2025-05-20 23:06:03.969434', '2025-05-20 23:06:03.969434');
INSERT INTO public.personas VALUES (4, 'Javier', 'Quintana', '1984-07-12', '3704123456', '2025-05-20 23:06:03.969434', '2025-05-20 23:06:03.969434');
INSERT INTO public.personas VALUES (5, 'Lourdes', 'Villalba', '1996-07-02', '3704551004', '2025-05-21 02:09:04.417579', '2025-05-21 02:09:04.417579');
INSERT INTO public.personas VALUES (6, 'Humberto', 'Ferreira', '1993-03-16', '3704124545', '2025-05-22 01:28:07.557566', '2025-05-22 01:28:07.557566');


--
-- TOC entry 3464 (class 0 OID 16629)
-- Dependencies: 227
-- Data for Name: productos; Type: TABLE DATA; Schema: public; Owner: prueba_db_n963_user
--

INSERT INTO public.productos VALUES (1, 'Dell XPS 13', 1400.00, 1, 'https://m.media-amazon.com/images/I/61kn7cyc46L._AC_SL1500_.jpg', 15, '2025-05-20 23:06:10.429419', '2025-05-20 23:06:10.429419');
INSERT INTO public.productos VALUES (2, 'MacBook Air M2', 1500.00, 1, 'https://http2.mlstatic.com/D_NQ_NP_2X_829933-MLU77338402190_072024-F.webp', 12, '2025-05-20 23:06:10.429419', '2025-05-20 23:06:10.429419');
INSERT INTO public.productos VALUES (3, 'iPhone 15', 1200.00, 2, 'https://media.es.wired.com/photos/6509d9b5c3cae8b32bec9d69/16:9/w_2560%2Cc_limit/iPhone-15-Pro-Review-Top-Gear.jpeg', 7, '2025-05-20 23:06:10.429419', '2025-05-20 23:06:10.429419');
INSERT INTO public.productos VALUES (4, 'Samsung Galaxy S24', 1100.00, 2, 'https://tiendaonline.movistar.com.ar/media/catalog/product/cache/1d01ed3f1ecf95fcf479279f9ae509ad/s/2/s24-ultra-256-titaniumblack-front_1_1.png', 9, '2025-05-20 23:06:10.429419', '2025-05-20 23:06:10.429419');
INSERT INTO public.productos VALUES (5, 'Logitech MX Master 3S', 100.00, 3, 'https://http2.mlstatic.com/D_NQ_NP_2X_945737-MLA50896130021_072022-F.webp', 5, '2025-05-20 23:06:10.429419', '2025-05-20 23:06:10.429419');
INSERT INTO public.productos VALUES (6, 'Cargador Anker Nano II 65W', 60.00, 3, 'https://ae01.alicdn.com/kf/Sf5332108f2cd44b1a9e568f3df00db19H.jpg', 20, '2025-05-20 23:06:10.429419', '2025-05-20 23:06:10.429419');
INSERT INTO public.productos VALUES (7, 'PlayStation 5', 500.00, 4, 'https://buenosairesimport.com/6494-large_default/playstation-5-slim-1-tb-digital.jpg', 14, '2025-05-20 23:06:10.429419', '2025-05-20 23:06:10.429419');
INSERT INTO public.productos VALUES (8, 'Razer BlackShark V2', 120.00, 4, 'https://static.nb.com.ar/img/e5d92864cfc942c29f4ec959eadb02bf.jpg', 13, '2025-05-20 23:06:10.429419', '2025-05-20 23:06:10.429419');


--
-- TOC entry 3459 (class 0 OID 16577)
-- Dependencies: 222
-- Data for Name: rol_usuarios; Type: TABLE DATA; Schema: public; Owner: prueba_db_n963_user
--

INSERT INTO public.rol_usuarios VALUES (1, 'admin');
INSERT INTO public.rol_usuarios VALUES (2, 'cliente');


--
-- TOC entry 3462 (class 0 OID 16600)
-- Dependencies: 225
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: prueba_db_n963_user
--

INSERT INTO public.usuarios VALUES (2, 's.gines15@gmail.com', '$2y$10$gTNdLDA.UC.aZjh7KeStsuZF/JENSuyrIdcUToqWxVOfWwtzR8dTO', 2, '2025-05-20 23:06:12.981834', '2025-05-20 23:06:12.981834');
INSERT INTO public.usuarios VALUES (1, 'ginesparker95@gmail.com', '$2y$10$1udXw5Atc1UdugKjIvpUz.AAOsKPcMzDkq9d8ZYjDwcx6JY8mi5dG', 1, '2025-05-20 23:06:12.981834', '2025-05-20 23:06:12.981834');
INSERT INTO public.usuarios VALUES (3, 'gerardomedinavv@gmail.com', '$2y$10$vWAZf0UQf7sUSCVhrfygdu.wNt3TZnfA4BcHuBbBtjtqv39Ok21AK', 2, '2025-05-20 23:06:12.981834', '2025-05-20 23:06:12.981834');
INSERT INTO public.usuarios VALUES (4, 'jajo@gmail.com', '$2y$10$KQtEHwJrTzKBKsFmb17OieN6M3FmWfEZLcRMq.51rEuDP6D45EbMW', 1, '2025-05-20 23:06:12.981834', '2025-05-20 23:06:12.981834');
INSERT INTO public.usuarios VALUES (5, 'vlourdes96@gmail.com', '$2y$10$Phz.xUboaAEl7up8z3eHhukhtOqZy89IKLq3vo3KC/IUhz.9QTetG', 2, '2025-05-21 02:09:06.126385', '2025-05-21 02:09:06.126385');
INSERT INTO public.usuarios VALUES (6, 'humber@gmail.com', '$2y$10$HQGHGmVWQUy28b5YkZQKJOornrI7zO5DgJ1Z7qoWgJ5dnaB9pFLay', 2, '2025-05-22 01:28:07.658119', '2025-05-22 01:28:07.658119');


--
-- TOC entry 3461 (class 0 OID 16584)
-- Dependencies: 224
-- Data for Name: ventas; Type: TABLE DATA; Schema: public; Owner: prueba_db_n963_user
--



--
-- TOC entry 3480 (class 0 OID 0)
-- Dependencies: 215
-- Name: categorias_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prueba_db_n963_user
--

SELECT pg_catalog.setval('public.categorias_id_seq', 1, false);


--
-- TOC entry 3481 (class 0 OID 0)
-- Dependencies: 217
-- Name: metodo_pagos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prueba_db_n963_user
--

SELECT pg_catalog.setval('public.metodo_pagos_id_seq', 1, false);


--
-- TOC entry 3482 (class 0 OID 0)
-- Dependencies: 219
-- Name: personas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prueba_db_n963_user
--

SELECT pg_catalog.setval('public.personas_id_seq', 6, true);


--
-- TOC entry 3483 (class 0 OID 0)
-- Dependencies: 226
-- Name: productos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prueba_db_n963_user
--

SELECT pg_catalog.setval('public.productos_id_seq', 1, false);


--
-- TOC entry 3484 (class 0 OID 0)
-- Dependencies: 221
-- Name: rol_usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prueba_db_n963_user
--

SELECT pg_catalog.setval('public.rol_usuarios_id_seq', 1, false);


--
-- TOC entry 3485 (class 0 OID 0)
-- Dependencies: 223
-- Name: ventas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prueba_db_n963_user
--

SELECT pg_catalog.setval('public.ventas_id_seq', 10, true);


--
-- TOC entry 3276 (class 2606 OID 16545)
-- Name: categorias categorias_pkey; Type: CONSTRAINT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.categorias
    ADD CONSTRAINT categorias_pkey PRIMARY KEY (id);


--
-- TOC entry 3294 (class 2606 OID 16673)
-- Name: detalle_productos detalle_productos_pkey; Type: CONSTRAINT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.detalle_productos
    ADD CONSTRAINT detalle_productos_pkey PRIMARY KEY (id_producto);


--
-- TOC entry 3292 (class 2606 OID 16648)
-- Name: detalle_ventas detalle_ventas_pkey; Type: CONSTRAINT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.detalle_ventas
    ADD CONSTRAINT detalle_ventas_pkey PRIMARY KEY (id_venta, id_productos);


--
-- TOC entry 3278 (class 2606 OID 16567)
-- Name: metodo_pagos metodo_pagos_pkey; Type: CONSTRAINT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.metodo_pagos
    ADD CONSTRAINT metodo_pagos_pkey PRIMARY KEY (id);


--
-- TOC entry 3280 (class 2606 OID 16575)
-- Name: personas personas_pkey; Type: CONSTRAINT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.personas
    ADD CONSTRAINT personas_pkey PRIMARY KEY (id);


--
-- TOC entry 3290 (class 2606 OID 16637)
-- Name: productos productos_pkey; Type: CONSTRAINT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.productos
    ADD CONSTRAINT productos_pkey PRIMARY KEY (id);


--
-- TOC entry 3282 (class 2606 OID 16582)
-- Name: rol_usuarios rol_usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.rol_usuarios
    ADD CONSTRAINT rol_usuarios_pkey PRIMARY KEY (id);


--
-- TOC entry 3286 (class 2606 OID 16606)
-- Name: usuarios usuarios_correo_key; Type: CONSTRAINT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_correo_key UNIQUE (correo);


--
-- TOC entry 3288 (class 2606 OID 16604)
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id_personas);


--
-- TOC entry 3284 (class 2606 OID 16589)
-- Name: ventas ventas_pkey; Type: CONSTRAINT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.ventas
    ADD CONSTRAINT ventas_pkey PRIMARY KEY (id);


--
-- TOC entry 3307 (class 2620 OID 16698)
-- Name: detalle_ventas trigger_descontar_stock; Type: TRIGGER; Schema: public; Owner: prueba_db_n963_user
--

CREATE TRIGGER trigger_descontar_stock AFTER INSERT ON public.detalle_ventas FOR EACH ROW EXECUTE FUNCTION public.descontar_stock();


--
-- TOC entry 3308 (class 2620 OID 16694)
-- Name: detalle_productos trigger_updated_at_detalle; Type: TRIGGER; Schema: public; Owner: prueba_db_n963_user
--

CREATE TRIGGER trigger_updated_at_detalle BEFORE UPDATE ON public.detalle_productos FOR EACH ROW EXECUTE FUNCTION public.actualizar_updated_at();


--
-- TOC entry 3303 (class 2620 OID 16695)
-- Name: personas trigger_updated_at_personas; Type: TRIGGER; Schema: public; Owner: prueba_db_n963_user
--

CREATE TRIGGER trigger_updated_at_personas BEFORE UPDATE ON public.personas FOR EACH ROW EXECUTE FUNCTION public.actualizar_updated_at();


--
-- TOC entry 3304 (class 2620 OID 16696)
-- Name: ventas trigger_updated_at_personas; Type: TRIGGER; Schema: public; Owner: prueba_db_n963_user
--

CREATE TRIGGER trigger_updated_at_personas BEFORE UPDATE ON public.ventas FOR EACH ROW EXECUTE FUNCTION public.actualizar_updated_at();


--
-- TOC entry 3306 (class 2620 OID 16693)
-- Name: productos trigger_updated_at_productos; Type: TRIGGER; Schema: public; Owner: prueba_db_n963_user
--

CREATE TRIGGER trigger_updated_at_productos BEFORE UPDATE ON public.productos FOR EACH ROW EXECUTE FUNCTION public.actualizar_updated_at();


--
-- TOC entry 3305 (class 2620 OID 16692)
-- Name: usuarios trigger_updated_at_usuarios; Type: TRIGGER; Schema: public; Owner: prueba_db_n963_user
--

CREATE TRIGGER trigger_updated_at_usuarios BEFORE UPDATE ON public.usuarios FOR EACH ROW EXECUTE FUNCTION public.actualizar_updated_at();


--
-- TOC entry 3302 (class 2606 OID 16674)
-- Name: detalle_productos detalle_productos_ibfk_1; Type: FK CONSTRAINT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.detalle_productos
    ADD CONSTRAINT detalle_productos_ibfk_1 FOREIGN KEY (id_producto) REFERENCES public.productos(id);


--
-- TOC entry 3300 (class 2606 OID 16649)
-- Name: detalle_ventas detalle_ventas_ibfk_1; Type: FK CONSTRAINT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.detalle_ventas
    ADD CONSTRAINT detalle_ventas_ibfk_1 FOREIGN KEY (id_venta) REFERENCES public.ventas(id);


--
-- TOC entry 3301 (class 2606 OID 16654)
-- Name: detalle_ventas detalle_ventas_ibfk_2; Type: FK CONSTRAINT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.detalle_ventas
    ADD CONSTRAINT detalle_ventas_ibfk_2 FOREIGN KEY (id_productos) REFERENCES public.productos(id);


--
-- TOC entry 3299 (class 2606 OID 16638)
-- Name: productos productos_ibfk_1; Type: FK CONSTRAINT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.productos
    ADD CONSTRAINT productos_ibfk_1 FOREIGN KEY (id_categoria) REFERENCES public.categorias(id);


--
-- TOC entry 3297 (class 2606 OID 16607)
-- Name: usuarios usuarios_ibfk_1; Type: FK CONSTRAINT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_ibfk_1 FOREIGN KEY (id_personas) REFERENCES public.personas(id) ON DELETE CASCADE;


--
-- TOC entry 3298 (class 2606 OID 16612)
-- Name: usuarios usuarios_ibfk_2; Type: FK CONSTRAINT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_ibfk_2 FOREIGN KEY (id_rol) REFERENCES public.rol_usuarios(id);


--
-- TOC entry 3295 (class 2606 OID 16590)
-- Name: ventas ventas_ibfk_1; Type: FK CONSTRAINT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.ventas
    ADD CONSTRAINT ventas_ibfk_1 FOREIGN KEY (id_personas) REFERENCES public.personas(id);


--
-- TOC entry 3296 (class 2606 OID 16595)
-- Name: ventas ventas_ibfk_2; Type: FK CONSTRAINT; Schema: public; Owner: prueba_db_n963_user
--

ALTER TABLE ONLY public.ventas
    ADD CONSTRAINT ventas_ibfk_2 FOREIGN KEY (id_metodo_pago) REFERENCES public.metodo_pagos(id);


--
-- TOC entry 3473 (class 0 OID 0)
-- Dependencies: 5
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: prueba_db_n963_user
--

REVOKE USAGE ON SCHEMA public FROM PUBLIC;


--
-- TOC entry 2078 (class 826 OID 16391)
-- Name: DEFAULT PRIVILEGES FOR SEQUENCES; Type: DEFAULT ACL; Schema: -; Owner: postgres
--

ALTER DEFAULT PRIVILEGES FOR ROLE postgres GRANT ALL ON SEQUENCES TO prueba_db_n963_user;


--
-- TOC entry 2080 (class 826 OID 16393)
-- Name: DEFAULT PRIVILEGES FOR TYPES; Type: DEFAULT ACL; Schema: -; Owner: postgres
--

ALTER DEFAULT PRIVILEGES FOR ROLE postgres GRANT ALL ON TYPES TO prueba_db_n963_user;


--
-- TOC entry 2079 (class 826 OID 16392)
-- Name: DEFAULT PRIVILEGES FOR FUNCTIONS; Type: DEFAULT ACL; Schema: -; Owner: postgres
--

ALTER DEFAULT PRIVILEGES FOR ROLE postgres GRANT ALL ON FUNCTIONS TO prueba_db_n963_user;


--
-- TOC entry 2077 (class 826 OID 16390)
-- Name: DEFAULT PRIVILEGES FOR TABLES; Type: DEFAULT ACL; Schema: -; Owner: postgres
--

ALTER DEFAULT PRIVILEGES FOR ROLE postgres GRANT SELECT,INSERT,REFERENCES,DELETE,TRIGGER,TRUNCATE,UPDATE ON TABLES TO prueba_db_n963_user;


-- Completed on 2025-05-22 12:13:06

--
-- PostgreSQL database dump complete
--

