PGDMP                         |         	   fregat_db    15.3    15.3 &    ?           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            @           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            A           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            B           1262    16461 	   fregat_db    DATABASE     }   CREATE DATABASE fregat_db WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Russian_Russia.1251';
    DROP DATABASE fregat_db;
                postgres    false                        3079    16513 	   uuid-ossp 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS "uuid-ossp" WITH SCHEMA public;
    DROP EXTENSION "uuid-ossp";
                   false            C           0    0    EXTENSION "uuid-ossp"    COMMENT     W   COMMENT ON EXTENSION "uuid-ossp" IS 'generate universally unique identifiers (UUIDs)';
                        false    2            �            1255    16490    generate_uuid()    FUNCTION     �   CREATE FUNCTION public.generate_uuid() RETURNS trigger
    LANGUAGE plpgsql
    AS $$BEGIN
    NEW.id := uuid_generate_v4();
    RETURN NEW;
END;
$$;
 &   DROP FUNCTION public.generate_uuid();
       public          postgres    false            �            1259    16585    link_inspections_smallbusines    TABLE     =  CREATE TABLE public.link_inspections_smallbusines (
    id integer NOT NULL,
    inspections_id uuid NOT NULL,
    small_business_entity_id uuid NOT NULL,
    create_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    update_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
 1   DROP TABLE public.link_inspections_smallbusines;
       public         heap    postgres    false            �            1259    16584    Inspections_smallbusines_id_seq    SEQUENCE     �   CREATE SEQUENCE public."Inspections_smallbusines_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 8   DROP SEQUENCE public."Inspections_smallbusines_id_seq";
       public          postgres    false    222            D           0    0    Inspections_smallbusines_id_seq    SEQUENCE OWNED BY     j   ALTER SEQUENCE public."Inspections_smallbusines_id_seq" OWNED BY public.link_inspections_smallbusines.id;
          public          postgres    false    221            �            1259    16505    rubricators    TABLE     z   CREATE TABLE public.rubricators (
    id integer NOT NULL,
    name character varying NOT NULL,
    parant_id smallint
);
    DROP TABLE public.rubricators;
       public         heap    postgres    false            �            1259    16504    References_id_seq    SEQUENCE     �   CREATE SEQUENCE public."References_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public."References_id_seq";
       public          postgres    false    220            E           0    0    References_id_seq    SEQUENCE OWNED BY     J   ALTER SEQUENCE public."References_id_seq" OWNED BY public.rubricators.id;
          public          postgres    false    219            �            1259    16462    files    TABLE     �   CREATE TABLE public.files (
    id uuid NOT NULL,
    path character varying,
    name character varying,
    create_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.files;
       public         heap    postgres    false            �            1259    16494    inspections    TABLE     �  CREATE TABLE public.inspections (
    id uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    create_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    update_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    planned_duration character varying,
    period_start date NOT NULL,
    period_end date NOT NULL,
    control_body integer NOT NULL,
    is_del boolean DEFAULT false NOT NULL
);
    DROP TABLE public.inspections;
       public         heap    postgres    false    2            �            1259    16480    small_business_entity    TABLE     ]  CREATE TABLE public.small_business_entity (
    id uuid NOT NULL,
    create_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    update_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    subject_name character varying NOT NULL,
    inn bigint,
    kpp integer,
    is_del boolean DEFAULT false NOT NULL
);
 )   DROP TABLE public.small_business_entity;
       public         heap    postgres    false            �            1259    16470    users    TABLE        CREATE TABLE public.users (
    id uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    is_del boolean DEFAULT false NOT NULL,
    login character varying(250) NOT NULL,
    password character varying(250) NOT NULL,
    last_name character varying(250) NOT NULL,
    first_name character varying(250) NOT NULL,
    patronymic character varying(250),
    update_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    create_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.users;
       public         heap    postgres    false    2            �           2604    16588     link_inspections_smallbusines id    DEFAULT     �   ALTER TABLE ONLY public.link_inspections_smallbusines ALTER COLUMN id SET DEFAULT nextval('public."Inspections_smallbusines_id_seq"'::regclass);
 O   ALTER TABLE public.link_inspections_smallbusines ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    222    221    222            �           2604    16508    rubricators id    DEFAULT     q   ALTER TABLE ONLY public.rubricators ALTER COLUMN id SET DEFAULT nextval('public."References_id_seq"'::regclass);
 =   ALTER TABLE public.rubricators ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    219    220    220            5          0    16462    files 
   TABLE DATA           <   COPY public.files (id, path, name, create_date) FROM stdin;
    public          postgres    false    215   �0       8          0    16494    inspections 
   TABLE DATA           �   COPY public.inspections (id, create_date, update_date, planned_duration, period_start, period_end, control_body, is_del) FROM stdin;
    public          postgres    false    218   �0       <          0    16585    link_inspections_smallbusines 
   TABLE DATA              COPY public.link_inspections_smallbusines (id, inspections_id, small_business_entity_id, create_date, update_date) FROM stdin;
    public          postgres    false    222   �1       :          0    16505    rubricators 
   TABLE DATA           :   COPY public.rubricators (id, name, parant_id) FROM stdin;
    public          postgres    false    220   b2       7          0    16480    small_business_entity 
   TABLE DATA           m   COPY public.small_business_entity (id, create_date, update_date, subject_name, inn, kpp, is_del) FROM stdin;
    public          postgres    false    217   �4       6          0    16470    users 
   TABLE DATA           y   COPY public.users (id, is_del, login, password, last_name, first_name, patronymic, update_date, create_date) FROM stdin;
    public          postgres    false    216   =5       F           0    0    Inspections_smallbusines_id_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public."Inspections_smallbusines_id_seq"', 9, true);
          public          postgres    false    221            G           0    0    References_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public."References_id_seq"', 30, true);
          public          postgres    false    219            �           2606    16510    rubricators References_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.rubricators
    ADD CONSTRAINT "References_pkey" PRIMARY KEY (id);
 G   ALTER TABLE ONLY public.rubricators DROP CONSTRAINT "References_pkey";
       public            postgres    false    220            �           2606    16469    files files_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.files
    ADD CONSTRAINT files_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.files DROP CONSTRAINT files_pkey;
       public            postgres    false    215            �           2606    16489 &   small_business_entity inspections_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.small_business_entity
    ADD CONSTRAINT inspections_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.small_business_entity DROP CONSTRAINT inspections_pkey;
       public            postgres    false    217            �           2606    16502    inspections inspections_pkey1 
   CONSTRAINT     [   ALTER TABLE ONLY public.inspections
    ADD CONSTRAINT inspections_pkey1 PRIMARY KEY (id);
 G   ALTER TABLE ONLY public.inspections DROP CONSTRAINT inspections_pkey1;
       public            postgres    false    218            �           2606    16593 @   link_inspections_smallbusines link_inspections_smallbusines_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.link_inspections_smallbusines
    ADD CONSTRAINT link_inspections_smallbusines_pkey PRIMARY KEY (id) INCLUDE (inspections_id, small_business_entity_id);
 j   ALTER TABLE ONLY public.link_inspections_smallbusines DROP CONSTRAINT link_inspections_smallbusines_pkey;
       public            postgres    false    222    222    222            �           2606    16479    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    216            �           1259    24668    fki_inspections_fkey    INDEX     h   CREATE INDEX fki_inspections_fkey ON public.link_inspections_smallbusines USING btree (inspections_id);
 (   DROP INDEX public.fki_inspections_fkey;
       public            postgres    false    222            �           2620    16492    files generate_uuid_triger    TRIGGER     x   CREATE TRIGGER generate_uuid_triger BEFORE INSERT ON public.files FOR EACH ROW EXECUTE FUNCTION public.generate_uuid();
 3   DROP TRIGGER generate_uuid_triger ON public.files;
       public          postgres    false    223    215            �           2620    16491 *   small_business_entity generate_uuid_triger    TRIGGER     �   CREATE TRIGGER generate_uuid_triger BEFORE INSERT ON public.small_business_entity FOR EACH ROW EXECUTE FUNCTION public.generate_uuid();
 C   DROP TRIGGER generate_uuid_triger ON public.small_business_entity;
       public          postgres    false    223    217            �           2606    24663 .   link_inspections_smallbusines inspections_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.link_inspections_smallbusines
    ADD CONSTRAINT inspections_fkey FOREIGN KEY (inspections_id) REFERENCES public.inspections(id) ON DELETE CASCADE NOT VALID;
 X   ALTER TABLE ONLY public.link_inspections_smallbusines DROP CONSTRAINT inspections_fkey;
       public          postgres    false    218    3229    222            �           2606    24653 1   link_inspections_smallbusines small_business_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.link_inspections_smallbusines
    ADD CONSTRAINT small_business_fkey FOREIGN KEY (small_business_entity_id) REFERENCES public.small_business_entity(id) ON DELETE CASCADE NOT VALID;
 [   ALTER TABLE ONLY public.link_inspections_smallbusines DROP CONSTRAINT small_business_fkey;
       public          postgres    false    3227    217    222            5      x������ � �      8   �   x�}�Aj�0@ѵ}
_`̌4�g|�n,ق �6P�	��BZZ(��ҍ���d�П�F#�H��BX� n�a��D��4H`�#3ZQ{�BF��v���:���khhR+3�^]�%�_#
�@F&+}�_2@�!��G�{k=9���1��)_�O�ȧr��g��.����e���������gə98��xI©v�%�)��!��:�W�Ae-qW���2�*��껔Ý������m�_h�xs      <   a   x�u���0 ��TE��8�p-���/�n �Yo��&[�X��5tsK�{4)׃j0�	�l�MX���:�hk#$�7��e�ʗ�4�/�{��k)�      :     x�uTQN�@��O�����d!@.�p�8n@��@�R�*���\�1�v�P�(�b�7;ov6>�Kie�S��J��щ�:�Si�v�b����eG��L~����}��Y����^Jy�;Y�/rx�5��(�+4m�\��ae�+����A&׶y��Z�7&C��e���ua|ׁ�0�*D4&����t��cB[�h�4`���.98Ʒ_ֆ��`��m�&L�z-�L
:�lb�O]O�6+�鈬���Mr�|�Ҏ�^,�65]
m����j=���U��"g�=�Q�㕣�oS���������w�����:`_�O6�d�z]�C`�Y�
��Y�D���\�c;�l���g�c�0�b���	ښ��1d��Q���`G���5!y����f���y���}����o���u�|B��$��"]����gT�t�D]gl�'�TH����'􅃟 �M�M�o��ϣ�K�#��~w���c&MuRaWť#�(�;//g'���H{�-��7�E�      7   �   x�}�;
�@E�d!��7����L�d!�ZZ؉n@-l\�dGF�.����&th�Cb�0*��y�\��
ȀҰ��=�΋z�5TN�ܴ�2��c>�gyͻ�"u>D���j�-'?����4g�H�T(�����f��.�'k�r-�r\v�D�D%�8Hd��$l����>�HT      6   '  x����J�P�盧p�z��N��B!�M?�D
.�6��Zmk1�����o �E(�R}���8�����w�p~��
�`b�BK���Lң�I���Ȣ=���cTay���o'�N��IBb.I�?��+��׵o�=�,�����Z�V�3O�v�	[�#x�mq������%ؔླྀ/W%.�#L`B1��V��R�_)N���f�S6��(��`�L�fRZ�לK-����ȍ������hڵ"
��á��B�L��7P��OƉ���x�������aW��_�������|����     