/*==============================================================*/
/* DBMS name:      PostgreSQL 8                                 */
/* Created on:     21/09/2015 10:32:20                          */
/*==============================================================*/


drop index CIDADE_X_BAIRRO_FK;

drop index BAIRRO_PK;

drop table BAIRRO;

drop index CATEGORIA_PK;

drop table CATEGORIA;

drop index ENDDETCIDADEXCIDDET_FK;

drop index CIDADEXCIDADEDETALHES_FK;

drop index CIDADEDETALHES_PK;

drop table CIDADEDETALHES;

drop index ESTADO_X_CIDADE_FK;

drop index PAIS_X_CIDADE_FK;

drop index CIDADES_PK;

drop table CIDADES;

drop index TIPO_X_SUBTIPOS_FK;

drop index DADOSTIPOSINFORMACOES_PK;

drop table DADOSTIPOSINFORMACOES;

drop index ENDDETALHESCIDADE_PK;

drop table ENDDETALHESCIDADE;

drop index ENDTIPOCOMPLEMENTO_PK;

drop table ENDTIPOCOMPLEMENTO;

drop index ENDTIPOCOORDENADA_PK;

drop table ENDTIPOCOORDENADA;

drop index ENDTIPOENDERECO_PK;

drop table ENDTIPOENDERECO;

drop index ENDTIPOVIA_PK;

drop table ENDTIPOVIA;

drop index PAIS_X_ESTADO_FK;

drop index ESTADO_PK;

drop table ESTADO;

drop index ESTADOCIVIL_PK;

drop table ESTADOCIVIL;

drop index ITPESQPRGDADTIPOSINF_FK;

drop index PESQPERGXIPESQPERG_FK;

drop index ITEMPESQUISAPERGUNTA_PK;

drop table ITEMPESQUISAPERGUNTA;

drop index ITPESQPRGITPESQRESP_FK;

drop index ITEMPESQUISARESPOSTA_PK;

drop table ITEMPESQUISARESPOSTA;

drop index MODULOS_PK;

drop table MODULOS;

drop index PAISES_PK;

drop table PAISES;

drop index PSQPRGTIPOPESQ_FK;

drop index PESQUISAPERGUNTAS_PK;

drop table PESQUISAPERGUNTAS;

drop index PESSOAXPESQUISAENTREVISTADOR_FK;

drop index PESQUISARESPOSTAENTREVISTADO_FK;

drop index PESQPERGPESQRESP_FK;

drop index PESQUISARESPOSTA_PK;

drop table PESQUISARESPOSTA;

drop index ESTCIVILPESSOA02_FK;

drop index CATEGORIA_X_PESSOA_FK;

drop index PESSOASEXO_FK;

drop index PESSOAQUALIFICACAO_FK;

drop index PESSOA_PK;

drop table PESSOA;

drop index PESPESAGENDA_FK;

drop index TIPOAGEPESAGENDA_FK;

drop table PESSOAAGENDA;

drop index TIPOCTATOXPESSOACTATO_FK;

drop index PESSOA_X_CONTATO_FK;

drop table PESSOACONTATO;

drop index TIPODOCTOXPESSOADOCTO_FK;

drop index PESSOA_X_DOCUMENTO_FK;

drop table PESSOADOCUMENTO;

drop index CIDADE_X_ENDERECO_PESSOA_FK;

drop index TIPO_VIA_X_ENDERECO_PESSOA_FK;

drop index TPCOMPLPESSOAEND_FK;

drop index TPCOORDPESSOAEND_FK;

drop index BAIRRO_X_ENDERECO_PESSOA_FK;

drop index ENDTPENDPESSEND_FK;

drop index PESSOA_X_ENDERECO_FK;

drop index PESSOAENDERECO_PK;

drop table PESSOAENDERECO;

drop index QUALIFICACAO_PK;

drop table QUALIFICACAO;

drop index SETOR_PK;

drop table SETOR;

drop index SEXO_PK;

drop table SEXO;

drop index TIPOAGENDA_PK;

drop table TIPOAGENDA;

drop index TIPOCONTATO_PK;

drop table TIPOCONTATO;

drop index TIPODETALHE_PK;

drop table TIPODETALHE;

drop index TIPODOCUMENTO_PK;

drop table TIPODOCUMENTO;

drop index TIPOENTIDADE_PK;

drop table TIPOENTIDADE;

drop index TIPOPESQUISA_PK;

drop table TIPOPESQUISA;

drop table TIPOPESSOA;

drop index TIPOSINFORMACOES_PK;

drop table TIPOSINFORMACOES;

drop index PESSOA_X_USUARIO_FK;

drop index USUARIO_PK;

drop table USUARIO;

drop index RELATIONSHIP_29_FK;

drop index USUARIO_X_USUARIO_MODULOS_FK;

drop table USUARIOMODULOS;

/*==============================================================*/
/* Table: BAIRRO                                                */
/*==============================================================*/
create table BAIRRO (
   BAI_ID               INT4                 not null,
   CID_ID               INT4                 null,
   BAI_NOME             VARCHAR(50)          null,
   BAI_ATIVO            CHAR(3)              null,
   constraint PK_BAIRRO primary key (BAI_ID)
);

/*==============================================================*/
/* Index: BAIRRO_PK                                             */
/*==============================================================*/
create unique index BAIRRO_PK on BAIRRO (
BAI_ID
);

/*==============================================================*/
/* Index: CIDADE_X_BAIRRO_FK                                    */
/*==============================================================*/
create  index CIDADE_X_BAIRRO_FK on BAIRRO (
CID_ID
);

/*==============================================================*/
/* Table: CATEGORIA                                             */
/*==============================================================*/
create table CATEGORIA (
   CATEG_ID             INT4                 not null,
   CATEG_DESCRICAO      VARCHAR(40)          null,
   CATEG_ATIVO          CHAR(3)              null,
   constraint PK_CATEGORIA primary key (CATEG_ID)
);

/*==============================================================*/
/* Index: CATEGORIA_PK                                          */
/*==============================================================*/
create unique index CATEGORIA_PK on CATEGORIA (
CATEG_ID
);

/*==============================================================*/
/* Table: CIDADEDETALHES                                        */
/*==============================================================*/
create table CIDADEDETALHES (
   CID_ID               INT4                 not null,
   DTCID_ID             INT4                 not null,
   CIDDET_VALOR         VARCHAR(200)         null,
   CIDDET_ATIVO         CHAR(3)              null,
   constraint PK_CIDADEDETALHES primary key (CID_ID, DTCID_ID)
);

/*==============================================================*/
/* Index: CIDADEDETALHES_PK                                     */
/*==============================================================*/
create unique index CIDADEDETALHES_PK on CIDADEDETALHES (
CID_ID,
DTCID_ID
);

/*==============================================================*/
/* Index: CIDADEXCIDADEDETALHES_FK                              */
/*==============================================================*/
create  index CIDADEXCIDADEDETALHES_FK on CIDADEDETALHES (
CID_ID
);

/*==============================================================*/
/* Index: ENDDETCIDADEXCIDDET_FK                                */
/*==============================================================*/
create  index ENDDETCIDADEXCIDDET_FK on CIDADEDETALHES (
DTCID_ID
);

/*==============================================================*/
/* Table: CIDADES                                               */
/*==============================================================*/
create table CIDADES (
   CID_ID               INT4                 not null,
   EST_ID               INT4                 null,
   PAIS_ID              INT4                 null,
   CID_NOME             VARCHAR(50)          null,
   CID_DDD              CHAR(4)              null,
   CID_ATIVO            CHAR(3)              null,
   constraint PK_CIDADES primary key (CID_ID)
);

/*==============================================================*/
/* Index: CIDADES_PK                                            */
/*==============================================================*/
create unique index CIDADES_PK on CIDADES (
CID_ID
);

/*==============================================================*/
/* Index: PAIS_X_CIDADE_FK                                      */
/*==============================================================*/
create  index PAIS_X_CIDADE_FK on CIDADES (
PAIS_ID
);

/*==============================================================*/
/* Index: ESTADO_X_CIDADE_FK                                    */
/*==============================================================*/
create  index ESTADO_X_CIDADE_FK on CIDADES (
EST_ID
);

/*==============================================================*/
/* Table: DADOSTIPOSINFORMACOES                                 */
/*==============================================================*/
create table DADOSTIPOSINFORMACOES (
   DTPINF_ID            INT4                 not null,
   TPINF_ID             INT4                 not null,
   DTPINF_DESCRICAO     VARCHAR(40)          null,
   DTPINF_ATIVO         CHAR(3)              null,
   DTPINF_VALOR         VARCHAR(40)          null,
   constraint PK_DADOSTIPOSINFORMACOES primary key (DTPINF_ID)
);

/*==============================================================*/
/* Index: DADOSTIPOSINFORMACOES_PK                              */
/*==============================================================*/
create unique index DADOSTIPOSINFORMACOES_PK on DADOSTIPOSINFORMACOES (
DTPINF_ID
);

/*==============================================================*/
/* Index: TIPO_X_SUBTIPOS_FK                                    */
/*==============================================================*/
create  index TIPO_X_SUBTIPOS_FK on DADOSTIPOSINFORMACOES (
TPINF_ID
);

/*==============================================================*/
/* Table: ENDDETALHESCIDADE                                     */
/*==============================================================*/
create table ENDDETALHESCIDADE (
   DTCID_ID             INT4                 not null,
   DTCID_DESCRICAO      VARCHAR(40)          null,
   DTCID_ATIVO          CHAR(3)              null,
   constraint PK_ENDDETALHESCIDADE primary key (DTCID_ID)
);

/*==============================================================*/
/* Index: ENDDETALHESCIDADE_PK                                  */
/*==============================================================*/
create unique index ENDDETALHESCIDADE_PK on ENDDETALHESCIDADE (
DTCID_ID
);

/*==============================================================*/
/* Table: ENDTIPOCOMPLEMENTO                                    */
/*==============================================================*/
create table ENDTIPOCOMPLEMENTO (
   TPCPL_ID             INT4                 not null,
   TPCPL_DESCRICAO      VARCHAR(40)          null,
   TPCPL_ATIVO          CHAR(3)              null,
   constraint PK_ENDTIPOCOMPLEMENTO primary key (TPCPL_ID)
);

/*==============================================================*/
/* Index: ENDTIPOCOMPLEMENTO_PK                                 */
/*==============================================================*/
create unique index ENDTIPOCOMPLEMENTO_PK on ENDTIPOCOMPLEMENTO (
TPCPL_ID
);

/*==============================================================*/
/* Table: ENDTIPOCOORDENADA                                     */
/*==============================================================*/
create table ENDTIPOCOORDENADA (
   TPCRD_ID             INT4                 not null,
   TPCRD_DESCRICAO      VARCHAR(40)          null,
   TPCRD_ATIVO          CHAR(3)              null,
   constraint PK_ENDTIPOCOORDENADA primary key (TPCRD_ID)
);

/*==============================================================*/
/* Index: ENDTIPOCOORDENADA_PK                                  */
/*==============================================================*/
create unique index ENDTIPOCOORDENADA_PK on ENDTIPOCOORDENADA (
TPCRD_ID
);

/*==============================================================*/
/* Table: ENDTIPOENDERECO                                       */
/*==============================================================*/
create table ENDTIPOENDERECO (
   TPEND_ID             INT4                 not null,
   TPEND_DESCRICAO      VARCHAR(40)          null,
   TPEND_ATIVO          CHAR(3)              null,
   constraint PK_ENDTIPOENDERECO primary key (TPEND_ID)
);

/*==============================================================*/
/* Index: ENDTIPOENDERECO_PK                                    */
/*==============================================================*/
create unique index ENDTIPOENDERECO_PK on ENDTIPOENDERECO (
TPEND_ID
);

/*==============================================================*/
/* Table: ENDTIPOVIA                                            */
/*==============================================================*/
create table ENDTIPOVIA (
   TPVIA_ID             INT4                 not null,
   TPVIA_DESCRICAO      VARCHAR(40)          null,
   TPVIA_ATIVO          CHAR(3)              null,
   constraint PK_ENDTIPOVIA primary key (TPVIA_ID)
);

/*==============================================================*/
/* Index: ENDTIPOVIA_PK                                         */
/*==============================================================*/
create unique index ENDTIPOVIA_PK on ENDTIPOVIA (
TPVIA_ID
);

/*==============================================================*/
/* Table: ESTADO                                                */
/*==============================================================*/
create table ESTADO (
   EST_ID               INT4                 not null,
   PAIS_ID              INT4                 null,
   EST_NOME             VARCHAR(40)          null,
   EST_SIGLA            CHAR(3)              null,
   EST_ATIVO            CHAR(3)              null,
   constraint PK_ESTADO primary key (EST_ID)
);

/*==============================================================*/
/* Index: ESTADO_PK                                             */
/*==============================================================*/
create unique index ESTADO_PK on ESTADO (
EST_ID
);

/*==============================================================*/
/* Index: PAIS_X_ESTADO_FK                                      */
/*==============================================================*/
create  index PAIS_X_ESTADO_FK on ESTADO (
PAIS_ID
);

/*==============================================================*/
/* Table: ESTADOCIVIL                                           */
/*==============================================================*/
create table ESTADOCIVIL (
   ESTCIV_ID            INT4                 not null,
   ESTCIV_DESCRICAO     VARCHAR(20)          null,
   ESTCIV_ATIVO         CHAR(3)              null,
   constraint PK_ESTADOCIVIL primary key (ESTCIV_ID)
);

/*==============================================================*/
/* Index: ESTADOCIVIL_PK                                        */
/*==============================================================*/
create unique index ESTADOCIVIL_PK on ESTADOCIVIL (
ESTCIV_ID
);

/*==============================================================*/
/* Table: ITEMPESQUISAPERGUNTA                                  */
/*==============================================================*/
create table ITEMPESQUISAPERGUNTA (
   PGPSQ_ID             INT4                 not null,
   DTPINF_ID            INT4                 not null,
   IPP_ID               INT4                 not null,
   constraint PK_ITEMPESQUISAPERGUNTA primary key (PGPSQ_ID, DTPINF_ID, IPP_ID)
);

/*==============================================================*/
/* Index: ITEMPESQUISAPERGUNTA_PK                               */
/*==============================================================*/
create unique index ITEMPESQUISAPERGUNTA_PK on ITEMPESQUISAPERGUNTA (
PGPSQ_ID,
DTPINF_ID,
IPP_ID
);

/*==============================================================*/
/* Index: PESQPERGXIPESQPERG_FK                                 */
/*==============================================================*/
create  index PESQPERGXIPESQPERG_FK on ITEMPESQUISAPERGUNTA (
PGPSQ_ID
);

/*==============================================================*/
/* Index: ITPESQPRGDADTIPOSINF_FK                               */
/*==============================================================*/
create  index ITPESQPRGDADTIPOSINF_FK on ITEMPESQUISAPERGUNTA (
DTPINF_ID
);

/*==============================================================*/
/* Table: ITEMPESQUISARESPOSTA                                  */
/*==============================================================*/
create table ITEMPESQUISARESPOSTA (
   PES_PGPSQ_ID         INT4                 not null,
   PSQRSP_ID            INT4                 not null,
   PGPSQ_ID             INT4                 not null,
   DTPINF_ID            INT4                 not null,
   IPP_ID               INT4                 not null,
   IPPR_ID              INT4                 null,
   constraint PK_ITEMPESQUISARESPOSTA primary key (PES_PGPSQ_ID, PSQRSP_ID)
);

/*==============================================================*/
/* Index: ITEMPESQUISARESPOSTA_PK                               */
/*==============================================================*/
create unique index ITEMPESQUISARESPOSTA_PK on ITEMPESQUISARESPOSTA (
PES_PGPSQ_ID,
PSQRSP_ID
);

/*==============================================================*/
/* Index: ITPESQPRGITPESQRESP_FK                                */
/*==============================================================*/
create  index ITPESQPRGITPESQRESP_FK on ITEMPESQUISARESPOSTA (
PGPSQ_ID,
DTPINF_ID,
IPP_ID
);

/*==============================================================*/
/* Table: MODULOS                                               */
/*==============================================================*/
create table MODULOS (
   MOD_ID               INT4                 not null,
   MOD_DESCRICAO        VARCHAR(40)          null,
   MOD_ATIVO            CHAR(3)              null,
   MOD_TOPO             CHAR(3)              null,
   MOD_MENUSUPERIOR     INT4                 null,
   constraint PK_MODULOS primary key (MOD_ID)
);

/*==============================================================*/
/* Index: MODULOS_PK                                            */
/*==============================================================*/
create unique index MODULOS_PK on MODULOS (
MOD_ID
);

/*==============================================================*/
/* Table: PAISES                                                */
/*==============================================================*/
create table PAISES (
   PAIS_ID              INT4                 not null,
   PAIS_NOME            VARCHAR(40)          null,
   PAIS_SIGLA           CHAR(3)              null,
   PAIS_DDI             CHAR(4)              null,
   PAIS_CODMERCOSUL     CHAR(5)              null,
   PAIS_ATIVO           CHAR(3)              null,
   constraint PK_PAISES primary key (PAIS_ID)
);

/*==============================================================*/
/* Index: PAISES_PK                                             */
/*==============================================================*/
create unique index PAISES_PK on PAISES (
PAIS_ID
);

/*==============================================================*/
/* Table: PESQUISAPERGUNTAS                                     */
/*==============================================================*/
create table PESQUISAPERGUNTAS (
   PGPSQ_ID             INT4                 not null,
   TPPSQ_ID             INT4                 not null,
   PGPSQ_ATIVO          CHAR(3)              null,
   PGPSQ_TITULO         VARCHAR(100)         null,
   PGPSQ_DATAELABORACAO DATE                 null,
   PGPSQ_DATAPESQUISA   DATE                 null,
   constraint PK_PESQUISAPERGUNTAS primary key (PGPSQ_ID)
);

/*==============================================================*/
/* Index: PESQUISAPERGUNTAS_PK                                  */
/*==============================================================*/
create unique index PESQUISAPERGUNTAS_PK on PESQUISAPERGUNTAS (
PGPSQ_ID
);

/*==============================================================*/
/* Index: PSQPRGTIPOPESQ_FK                                     */
/*==============================================================*/
create  index PSQPRGTIPOPESQ_FK on PESQUISAPERGUNTAS (
TPPSQ_ID
);

/*==============================================================*/
/* Table: PESQUISARESPOSTA                                      */
/*==============================================================*/
create table PESQUISARESPOSTA (
   PGPSQ_ID             INT4                 not null,
   PSQRSP_ID            INT4                 not null,
   PES_ID               INT4                 not null,
   PES_PES_ID           INT4                 not null,
   PSQRSP_DATARESPOSTAS DATE                 null,
   PSQRSP_DATAENTREGA   DATE                 null,
   constraint PK_PESQUISARESPOSTA primary key (PGPSQ_ID, PSQRSP_ID)
);

/*==============================================================*/
/* Index: PESQUISARESPOSTA_PK                                   */
/*==============================================================*/
create unique index PESQUISARESPOSTA_PK on PESQUISARESPOSTA (
PGPSQ_ID,
PSQRSP_ID
);

/*==============================================================*/
/* Index: PESQPERGPESQRESP_FK                                   */
/*==============================================================*/
create  index PESQPERGPESQRESP_FK on PESQUISARESPOSTA (
PGPSQ_ID
);

/*==============================================================*/
/* Index: PESQUISARESPOSTAENTREVISTADO_FK                       */
/*==============================================================*/
create  index PESQUISARESPOSTAENTREVISTADO_FK on PESQUISARESPOSTA (
PES_ID
);

/*==============================================================*/
/* Index: PESSOAXPESQUISAENTREVISTADOR_FK                       */
/*==============================================================*/
create  index PESSOAXPESQUISAENTREVISTADOR_FK on PESQUISARESPOSTA (
PES_PES_ID
);

/*==============================================================*/
/* Table: PESSOA                                                */
/*==============================================================*/
create table PESSOA (
   PES_ID               INT4                 not null,
   QLF_ID               INT4                 null,
   ESTCIV_ID            INT4                 null,
   SEXO_ID              INT4                 null,
   CATEG_ID             INT4                 null,
   PES_NOME             VARCHAR(50)          null,
   PES_MAE              VARCHAR(50)          null,
   PES_PAI              VARCHAR(50)          null,
   PES_GENERO           CHAR(10)             null,
   PES_CPFCNPJ          VARCHAR(18)          null,
   PES_DTNASC           DATE                 null,
   PES_EMAIL            VARCHAR(200)         null,
   PES_APELIDO          VARCHAR(20)          null,
   PES_DDDTELFIXO       CHAR(3)              null,
   PES_TELFIXO          CHAR(10)             null,
   PES_DDDCEL           CHAR(3)              null,
   PES_TELCELULAR       CHAR(3)              null,
   PES_NOMECONJUGE      VARCHAR(50)          null,
   PES_DTNASCCONJUGE    DATE                 null,
   PES_FOTO             VARCHAR(200)         null,
   PES_ATIVO            CHAR(3)              null,
   constraint PK_PESSOA primary key (PES_ID)
);

/*==============================================================*/
/* Index: PESSOA_PK                                             */
/*==============================================================*/
create unique index PESSOA_PK on PESSOA (
PES_ID
);

/*==============================================================*/
/* Index: PESSOAQUALIFICACAO_FK                                 */
/*==============================================================*/
create  index PESSOAQUALIFICACAO_FK on PESSOA (
QLF_ID
);

/*==============================================================*/
/* Index: PESSOASEXO_FK                                         */
/*==============================================================*/
create  index PESSOASEXO_FK on PESSOA (
SEXO_ID
);

/*==============================================================*/
/* Index: CATEGORIA_X_PESSOA_FK                                 */
/*==============================================================*/
create  index CATEGORIA_X_PESSOA_FK on PESSOA (
CATEG_ID
);

/*==============================================================*/
/* Index: ESTCIVILPESSOA02_FK                                   */
/*==============================================================*/
create  index ESTCIVILPESSOA02_FK on PESSOA (
ESTCIV_ID
);

/*==============================================================*/
/* Table: PESSOAAGENDA                                          */
/*==============================================================*/
create table PESSOAAGENDA (
   PES_ID               INT4                 null,
   TPAGE_ID             INT4                 null,
   PESAG_DADOITEMAGENDA VARCHAR(200)         null,
   PESAG_ATIVO          CHAR(3)              null
);

/*==============================================================*/
/* Index: TIPOAGEPESAGENDA_FK                                   */
/*==============================================================*/
create  index TIPOAGEPESAGENDA_FK on PESSOAAGENDA (
TPAGE_ID
);

/*==============================================================*/
/* Index: PESPESAGENDA_FK                                       */
/*==============================================================*/
create  index PESPESAGENDA_FK on PESSOAAGENDA (
PES_ID
);

/*==============================================================*/
/* Table: PESSOACONTATO                                         */
/*==============================================================*/
create table PESSOACONTATO (
   PES_ID               INT4                 null,
   TPCONT_ID            INT4                 null,
   PESCTT_DADOCONTATO   VARCHAR(200)         null,
   PESCTT_ATIVO         CHAR(3)              null
);

/*==============================================================*/
/* Index: PESSOA_X_CONTATO_FK                                   */
/*==============================================================*/
create  index PESSOA_X_CONTATO_FK on PESSOACONTATO (
PES_ID
);

/*==============================================================*/
/* Index: TIPOCTATOXPESSOACTATO_FK                              */
/*==============================================================*/
create  index TIPOCTATOXPESSOACTATO_FK on PESSOACONTATO (
TPCONT_ID
);

/*==============================================================*/
/* Table: PESSOADOCUMENTO                                       */
/*==============================================================*/
create table PESSOADOCUMENTO (
   TPDOC_ID             INT4                 null,
   PES_ID               INT4                 null,
   PESDOC_DADODOCUMENTO VARCHAR(50)          null,
   PESDOC_ATIVO         CHAR(3)              null
);

/*==============================================================*/
/* Index: PESSOA_X_DOCUMENTO_FK                                 */
/*==============================================================*/
create  index PESSOA_X_DOCUMENTO_FK on PESSOADOCUMENTO (
PES_ID
);

/*==============================================================*/
/* Index: TIPODOCTOXPESSOADOCTO_FK                              */
/*==============================================================*/
create  index TIPODOCTOXPESSOADOCTO_FK on PESSOADOCUMENTO (
TPDOC_ID
);

/*==============================================================*/
/* Table: PESSOAENDERECO                                        */
/*==============================================================*/
create table PESSOAENDERECO (
   PESEND_ID            INT4                 not null,
   TPVIA_ID             INT4                 null,
   BAI_ID               INT4                 null,
   TPEND_ID             INT4                 null,
   TPCPL_ID             INT4                 null,
   PES_ID               INT4                 null,
   CID_ID               INT4                 null,
   TPCRD_ID             INT4                 null,
   constraint PK_PESSOAENDERECO primary key (PESEND_ID)
);

/*==============================================================*/
/* Index: PESSOAENDERECO_PK                                     */
/*==============================================================*/
create unique index PESSOAENDERECO_PK on PESSOAENDERECO (
PESEND_ID
);

/*==============================================================*/
/* Index: PESSOA_X_ENDERECO_FK                                  */
/*==============================================================*/
create  index PESSOA_X_ENDERECO_FK on PESSOAENDERECO (
PES_ID
);

/*==============================================================*/
/* Index: ENDTPENDPESSEND_FK                                    */
/*==============================================================*/
create  index ENDTPENDPESSEND_FK on PESSOAENDERECO (
TPEND_ID
);

/*==============================================================*/
/* Index: BAIRRO_X_ENDERECO_PESSOA_FK                           */
/*==============================================================*/
create  index BAIRRO_X_ENDERECO_PESSOA_FK on PESSOAENDERECO (
BAI_ID
);

/*==============================================================*/
/* Index: TPCOORDPESSOAEND_FK                                   */
/*==============================================================*/
create  index TPCOORDPESSOAEND_FK on PESSOAENDERECO (
TPCRD_ID
);

/*==============================================================*/
/* Index: TPCOMPLPESSOAEND_FK                                   */
/*==============================================================*/
create  index TPCOMPLPESSOAEND_FK on PESSOAENDERECO (
TPCPL_ID
);

/*==============================================================*/
/* Index: TIPO_VIA_X_ENDERECO_PESSOA_FK                         */
/*==============================================================*/
create  index TIPO_VIA_X_ENDERECO_PESSOA_FK on PESSOAENDERECO (
TPVIA_ID
);

/*==============================================================*/
/* Index: CIDADE_X_ENDERECO_PESSOA_FK                           */
/*==============================================================*/
create  index CIDADE_X_ENDERECO_PESSOA_FK on PESSOAENDERECO (
CID_ID
);

/*==============================================================*/
/* Table: QUALIFICACAO                                          */
/*==============================================================*/
create table QUALIFICACAO (
   QLF_ID               INT4                 not null,
   QLF_DESCRICAO        VARCHAR(30)          null,
   QLF_ATIVO            CHAR(3)              null,
   QLF_CANDIDATO        CHAR(3)              null,
   QLF_CABOELEITORAL    CHAR(3)              null,
   QLF_ELEITOR          CHAR(3)              null,
   constraint PK_QUALIFICACAO primary key (QLF_ID)
);

/*==============================================================*/
/* Index: QUALIFICACAO_PK                                       */
/*==============================================================*/
create unique index QUALIFICACAO_PK on QUALIFICACAO (
QLF_ID
);

/*==============================================================*/
/* Table: SETOR                                                 */
/*==============================================================*/
create table SETOR (
   SETOR_ID             INT4                 not null,
   SETOR_DESCRICAO      VARCHAR(20)          null,
   SETOR_ATIVO          CHAR(3)              null,
   constraint PK_SETOR primary key (SETOR_ID)
);

/*==============================================================*/
/* Index: SETOR_PK                                              */
/*==============================================================*/
create unique index SETOR_PK on SETOR (
SETOR_ID
);

/*==============================================================*/
/* Table: SEXO                                                  */
/*==============================================================*/
create table SEXO (
   SEXO_ID              INT4                 not null,
   SEXO_DESCRICAO       VARCHAR(20)          null,
   SEOX_ATIVO           CHAR(3)              null,
   constraint PK_SEXO primary key (SEXO_ID)
);

/*==============================================================*/
/* Index: SEXO_PK                                               */
/*==============================================================*/
create unique index SEXO_PK on SEXO (
SEXO_ID
);

/*==============================================================*/
/* Table: TIPOAGENDA                                            */
/*==============================================================*/
create table TIPOAGENDA (
   TPAGE_ID             INT4                 not null,
   TPAGE_DESCRICAO      VARCHAR(40)          null,
   TPAGE_ATIVO          CHAR(3)              null,
   constraint PK_TIPOAGENDA primary key (TPAGE_ID)
);

/*==============================================================*/
/* Index: TIPOAGENDA_PK                                         */
/*==============================================================*/
create unique index TIPOAGENDA_PK on TIPOAGENDA (
TPAGE_ID
);

/*==============================================================*/
/* Table: TIPOCONTATO                                           */
/*==============================================================*/
create table TIPOCONTATO (
   TPCONT_ID            INT4                 not null,
   TPCONT_DESCRICAO     VARCHAR(40)          null,
   TPCONT_ATIVO         CHAR(3)              null,
   constraint PK_TIPOCONTATO primary key (TPCONT_ID)
);

/*==============================================================*/
/* Index: TIPOCONTATO_PK                                        */
/*==============================================================*/
create unique index TIPOCONTATO_PK on TIPOCONTATO (
TPCONT_ID
);

/*==============================================================*/
/* Table: TIPODETALHE                                           */
/*==============================================================*/
create table TIPODETALHE (
   TPDET_ID             INT4                 not null,
   TPDET_DESCRICAO      VARCHAR(40)          null,
   TPDET_ATIVO          CHAR(3)              null,
   constraint PK_TIPODETALHE primary key (TPDET_ID)
);

/*==============================================================*/
/* Index: TIPODETALHE_PK                                        */
/*==============================================================*/
create unique index TIPODETALHE_PK on TIPODETALHE (
TPDET_ID
);

/*==============================================================*/
/* Table: TIPODOCUMENTO                                         */
/*==============================================================*/
create table TIPODOCUMENTO (
   TPDOC_ID             INT4                 not null,
   TPDOC_DESCRICAO      VARCHAR(40)          null,
   TPDOC_ATIVO          CHAR(3)              null,
   constraint PK_TIPODOCUMENTO primary key (TPDOC_ID)
);

/*==============================================================*/
/* Index: TIPODOCUMENTO_PK                                      */
/*==============================================================*/
create unique index TIPODOCUMENTO_PK on TIPODOCUMENTO (
TPDOC_ID
);

/*==============================================================*/
/* Table: TIPOENTIDADE                                          */
/*==============================================================*/
create table TIPOENTIDADE (
   TPENT_ID             INT4                 not null,
   TPENT_DESCRICAO      VARCHAR(40)          null,
   TPENT_ATIVO          CHAR(3)              null,
   constraint PK_TIPOENTIDADE primary key (TPENT_ID)
);

/*==============================================================*/
/* Index: TIPOENTIDADE_PK                                       */
/*==============================================================*/
create unique index TIPOENTIDADE_PK on TIPOENTIDADE (
TPENT_ID
);

/*==============================================================*/
/* Table: TIPOPESQUISA                                          */
/*==============================================================*/
create table TIPOPESQUISA (
   TPPSQ_ID             INT4                 not null,
   TPPSQ_DESCRICAO      VARCHAR(20)          null,
   TPPSQ_ATIVO          CHAR(3)              null,
   TPPSQ_USATIPOINFORMACAO CHAR(3)              null,
   constraint PK_TIPOPESQUISA primary key (TPPSQ_ID)
);

/*==============================================================*/
/* Index: TIPOPESQUISA_PK                                       */
/*==============================================================*/
create unique index TIPOPESQUISA_PK on TIPOPESQUISA (
TPPSQ_ID
);

/*==============================================================*/
/* Table: TIPOPESSOA                                            */
/*==============================================================*/
create table TIPOPESSOA (
   TPPES_ID             INT4                 null,
   TPPES_DESCRICAO      VARCHAR(20)          null,
   TPPES_ATIVO          CHAR(3)              null
);

/*==============================================================*/
/* Table: TIPOSINFORMACOES                                      */
/*==============================================================*/
create table TIPOSINFORMACOES (
   TPINF_ID             INT4                 not null,
   TPINF_CODIGO         INT4                 null,
   TPINF_DESCRICAO      VARCHAR(40)          null,
   TPINF_ATIVO          CHAR(3)              null,
   constraint PK_TIPOSINFORMACOES primary key (TPINF_ID)
);

/*==============================================================*/
/* Index: TIPOSINFORMACOES_PK                                   */
/*==============================================================*/
create unique index TIPOSINFORMACOES_PK on TIPOSINFORMACOES (
TPINF_ID
);

/*==============================================================*/
/* Table: USUARIO                                               */
/*==============================================================*/
create table USUARIO (
   USU_ID               INT4                 not null,
   PES_ID               INT4                 null,
   USU_MATRICULA        INT4                 null,
   USU_LOGIN            VARCHAR(50)          null,
   USU_SENHA            CHAR(10)             null,
   constraint PK_USUARIO primary key (USU_ID)
);

/*==============================================================*/
/* Index: USUARIO_PK                                            */
/*==============================================================*/
create unique index USUARIO_PK on USUARIO (
USU_ID
);

/*==============================================================*/
/* Index: PESSOA_X_USUARIO_FK                                   */
/*==============================================================*/
create  index PESSOA_X_USUARIO_FK on USUARIO (
PES_ID
);

/*==============================================================*/
/* Table: USUARIOMODULOS                                        */
/*==============================================================*/
create table USUARIOMODULOS (
   USU_ID               INT4                 not null,
   MOD_ID               INT4                 not null,
   MODUSU_ATIVO         CHAR(3)              null
);

/*==============================================================*/
/* Index: USUARIO_X_USUARIO_MODULOS_FK                          */
/*==============================================================*/
create  index USUARIO_X_USUARIO_MODULOS_FK on USUARIOMODULOS (
USU_ID
);

/*==============================================================*/
/* Index: RELATIONSHIP_29_FK                                    */
/*==============================================================*/
create  index RELATIONSHIP_29_FK on USUARIOMODULOS (
MOD_ID
);

alter table BAIRRO
   add constraint FK_BAIRRO_CIDADE_X__CIDADES foreign key (CID_ID)
      references CIDADES (CID_ID)
      on delete restrict on update restrict;

alter table CIDADEDETALHES
   add constraint FK_CIDADEDE_CIDADEXCI_CIDADES foreign key (CID_ID)
      references CIDADES (CID_ID)
      on delete restrict on update restrict;

alter table CIDADEDETALHES
   add constraint FK_CIDADEDE_ENDDETCID_ENDDETAL foreign key (DTCID_ID)
      references ENDDETALHESCIDADE (DTCID_ID)
      on delete restrict on update restrict;

alter table CIDADES
   add constraint FK_CIDADES_ESTADO_X__ESTADO foreign key (EST_ID)
      references ESTADO (EST_ID)
      on delete restrict on update restrict;

alter table CIDADES
   add constraint FK_CIDADES_PAIS_X_CI_PAISES foreign key (PAIS_ID)
      references PAISES (PAIS_ID)
      on delete restrict on update restrict;

alter table DADOSTIPOSINFORMACOES
   add constraint FK_DADOSTIP_TIPO_X_SU_TIPOSINF foreign key (TPINF_ID)
      references TIPOSINFORMACOES (TPINF_ID)
      on delete restrict on update restrict;

alter table ESTADO
   add constraint FK_ESTADO_PAIS_X_ES_PAISES foreign key (PAIS_ID)
      references PAISES (PAIS_ID)
      on delete restrict on update restrict;

alter table ITEMPESQUISAPERGUNTA
   add constraint FK_ITEMPESQ_ITPESQPRG_DADOSTIP foreign key (DTPINF_ID)
      references DADOSTIPOSINFORMACOES (DTPINF_ID)
      on delete restrict on update restrict;

alter table ITEMPESQUISAPERGUNTA
   add constraint FK_ITEMPESQ_PESQPERGX_PESQUISA foreign key (PGPSQ_ID)
      references PESQUISAPERGUNTAS (PGPSQ_ID)
      on delete restrict on update restrict;

alter table ITEMPESQUISARESPOSTA
   add constraint FK_ITEMPESQ_ITPESQPRG_ITEMPESQ foreign key (PGPSQ_ID, DTPINF_ID, IPP_ID)
      references ITEMPESQUISAPERGUNTA (PGPSQ_ID, DTPINF_ID, IPP_ID)
      on delete restrict on update restrict;

alter table ITEMPESQUISARESPOSTA
   add constraint FK_ITEMPESQ_PESQRESPI_PESQUISA foreign key (PES_PGPSQ_ID, PSQRSP_ID)
      references PESQUISARESPOSTA (PGPSQ_ID, PSQRSP_ID)
      on delete restrict on update restrict;

alter table PESQUISAPERGUNTAS
   add constraint FK_PESQUISA_PSQPRGTIP_TIPOPESQ foreign key (TPPSQ_ID)
      references TIPOPESQUISA (TPPSQ_ID)
      on delete restrict on update restrict;

alter table PESQUISARESPOSTA
   add constraint FK_PESQUISA_PESQPERGP_PESQUISA foreign key (PGPSQ_ID)
      references PESQUISAPERGUNTAS (PGPSQ_ID)
      on delete restrict on update restrict;

alter table PESQUISARESPOSTA
   add constraint FK_PESQUISA_PESQUISAR_PESSOA foreign key (PES_ID)
      references PESSOA (PES_ID)
      on delete restrict on update restrict;

alter table PESQUISARESPOSTA
   add constraint FK_PESQUISA_PESSOAXPE_PESSOA foreign key (PES_PES_ID)
      references PESSOA (PES_ID)
      on delete restrict on update restrict;

alter table PESSOA
   add constraint FK_PESSOA_CATEGORIA_CATEGORI foreign key (CATEG_ID)
      references CATEGORIA (CATEG_ID)
      on delete restrict on update restrict;

alter table PESSOA
   add constraint FK_PESSOA_ESTCIVILP_ESTADOCI foreign key (ESTCIV_ID)
      references ESTADOCIVIL (ESTCIV_ID)
      on delete restrict on update restrict;

alter table PESSOA
   add constraint FK_PESSOA_PESSOAQUA_QUALIFIC foreign key (QLF_ID)
      references QUALIFICACAO (QLF_ID)
      on delete restrict on update restrict;

alter table PESSOA
   add constraint FK_PESSOA_PESSOASEX_SEXO foreign key (SEXO_ID)
      references SEXO (SEXO_ID)
      on delete restrict on update restrict;

alter table PESSOAAGENDA
   add constraint FK_PESSOAAG_PESPESAGE_PESSOA foreign key (PES_ID)
      references PESSOA (PES_ID)
      on delete restrict on update restrict;

alter table PESSOAAGENDA
   add constraint FK_PESSOAAG_TIPOAGEPE_TIPOAGEN foreign key (TPAGE_ID)
      references TIPOAGENDA (TPAGE_ID)
      on delete restrict on update restrict;

alter table PESSOACONTATO
   add constraint FK_PESSOACO_PESSOA_X__PESSOA foreign key (PES_ID)
      references PESSOA (PES_ID)
      on delete restrict on update restrict;

alter table PESSOACONTATO
   add constraint FK_PESSOACO_TIPOCTATO_TIPOCONT foreign key (TPCONT_ID)
      references TIPOCONTATO (TPCONT_ID)
      on delete restrict on update restrict;

alter table PESSOADOCUMENTO
   add constraint FK_PESSOADO_PESSOA_X__PESSOA foreign key (PES_ID)
      references PESSOA (PES_ID)
      on delete restrict on update restrict;

alter table PESSOADOCUMENTO
   add constraint FK_PESSOADO_TIPODOCTO_TIPODOCU foreign key (TPDOC_ID)
      references TIPODOCUMENTO (TPDOC_ID)
      on delete restrict on update restrict;

alter table PESSOAENDERECO
   add constraint FK_PESSOAEN_BAIRRO_X__BAIRRO foreign key (BAI_ID)
      references BAIRRO (BAI_ID)
      on delete restrict on update restrict;

alter table PESSOAENDERECO
   add constraint FK_PESSOAEN_CIDADE_X__CIDADES foreign key (CID_ID)
      references CIDADES (CID_ID)
      on delete restrict on update restrict;

alter table PESSOAENDERECO
   add constraint FK_PESSOAEN_ENDTPENDP_ENDTIPOE foreign key (TPEND_ID)
      references ENDTIPOENDERECO (TPEND_ID)
      on delete restrict on update restrict;

alter table PESSOAENDERECO
   add constraint FK_PESSOAEN_PESSOA_X__PESSOA foreign key (PES_ID)
      references PESSOA (PES_ID)
      on delete restrict on update restrict;

alter table PESSOAENDERECO
   add constraint FK_PESSOAEN_TIPO_VIA__ENDTIPOV foreign key (TPVIA_ID)
      references ENDTIPOVIA (TPVIA_ID)
      on delete restrict on update restrict;

alter table PESSOAENDERECO
   add constraint FK_PESSOAEN_TPCOMPLPE_ENDTIPOC foreign key (TPCPL_ID)
      references ENDTIPOCOMPLEMENTO (TPCPL_ID)
      on delete restrict on update restrict;

alter table PESSOAENDERECO
   add constraint FK_PESSOAEN_TPCOORDPE_ENDTIPOC foreign key (TPCRD_ID)
      references ENDTIPOCOORDENADA (TPCRD_ID)
      on delete restrict on update restrict;

alter table USUARIO
   add constraint FK_USUARIO_PESSOA_X__PESSOA foreign key (PES_ID)
      references PESSOA (PES_ID)
      on delete restrict on update restrict;

alter table USUARIOMODULOS
   add constraint FK_USUARIOM_RELATIONS_MODULOS foreign key (MOD_ID)
      references MODULOS (MOD_ID)
      on delete restrict on update restrict;

alter table USUARIOMODULOS
   add constraint FK_USUARIOM_USUARIO_X_USUARIO foreign key (USU_ID)
      references USUARIO (USU_ID)
      on delete restrict on update restrict;

