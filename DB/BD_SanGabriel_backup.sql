USE [master]
GO

CREATE DATABASE [BD_SanGabriel]
GO

USE [BD_SanGabriel]
GO

CREATE TABLE [dbo].[TBL_Roles] (
	[RolID]     [bigint] IDENTITY(1,1) NOT NULL,
	[NombreRol] [varchar](50)          NOT NULL,
	CONSTRAINT [PK_Roles] PRIMARY KEY CLUSTERED ([RolID] ASC)
);

CREATE TABLE [dbo].[TBL_Usuarios] (
	[UsuarioID]      [bigint] IDENTITY(1,1) NOT NULL,
	[Identificacion] [varchar](15)          NOT NULL,
	[Nombre]         [varchar](50)          NOT NULL,
	[Apellidos]      [varchar](100)         NOT NULL,
	[Correo]         [varchar](100)         NOT NULL,
	[Contrasenna]    [varchar](255)         NOT NULL,
	[FechaRegistro]  [datetime]             DEFAULT CURRENT_TIMESTAMP,
	[RolID]          [bigint]               NOT NULL,
	[Estado]         [bit]                  NOT NULL,
	CONSTRAINT [UQ_Usuario_Correo] UNIQUE ([Correo]),
	CONSTRAINT [UQ_Usuario_Identificacion] UNIQUE ([Identificacion]),
	CONSTRAINT [PK_Usuarios] PRIMARY KEY CLUSTERED ([UsuarioID] ASC),
	CONSTRAINT [FK_Usuario_Rol] FOREIGN KEY ([RolID]) REFERENCES [dbo].[TBL_Roles]([RolID])
);

CREATE TABLE [dbo].[TBL_Beneficiarios] (
	[BeneficiarioID]  [bigint] IDENTITY(1,1) NOT NULL,
	[Identificacion]  [varchar](15)          NOT NULL,
	[Nombre]          [varchar](50)          NOT NULL,
	[Apellidos]       [varchar](100)         NOT NULL,
	[FechaNacimiento] [date]                 NOT NULL,
	[Edad]            [int]                  NOT NULL,
	[Genero]          [varchar](10)          NOT NULL,
	[Alergias]        [varchar](100)         NULL,
	[Medicamentos]    [varchar](100)         NULL,
	[FechaIngreso]    [datetime]             DEFAULT CURRENT_TIMESTAMP,
	[Encargado]       [varchar](100)         NOT NULL,
	[Contacto]        [varchar](50)          NOT NULL,
	[Pago]            [decimal](10,2)        NULL,
	[ProgramaID]      [bigint]               NOT NULL,
	[GrupoID]         [bigint]               NOT NULL,
	CONSTRAINT [PK_Beneficiarios] PRIMARY KEY CLUSTERED ([BeneficiarioID] ASC),
	CONSTRAINT [FK_Beneficiario_Programa] FOREIGN KEY ([ProgramaID]) REFERENCES [dbo].[TBL_Programas]([ProgramaID]),
	CONSTRAINT [FK_Beneficiario_Grupo] FOREIGN KEY ([GrupoID]) REFERENCES [dbo].[TBL_Grupos]([GrupoID])
);

CREATE TABLE [dbo].[TBL_Grupos] (
	[GrupoID]        [bigint] IDENTITY(1,1) NOT NULL,
	[Codigo]         [varchar](10)          NOT NULL,
	[Nombre]         [varchar](50)          NOT NULL,
	[Descripcion]    [varchar](max)         NOT NULL,
	[Estado]         [bit]                  NOT NULL,
	CONSTRAINT [PK_Grupos] PRIMARY KEY CLUSTERED ([GrupoID] ASC)
);

CREATE TABLE [dbo].[TBL_Programas] (
	[ProgramaID]     [bigint] IDENTITY(1,1) NOT NULL,
	[Nombre]         [varchar](50)          NOT NULL,
	[Descripcion]    [varchar](max)         NOT NULL,
	[Estado]         [bit]                  NOT NULL,
	CONSTRAINT [PK_Programas] PRIMARY KEY CLUSTERED ([ProgramaID] ASC)
);

CREATE TABLE [dbo].[TBL_AuditoriaErrores] (
	[ErrorID]   [bigint] IDENTITY(1,1) NOT NULL,
	[Accion]    [varchar](100)         NOT NULL,
	[Origen]    [varchar](250)         NOT NULL,
	[FechaHora] [datetime]             DEFAULT CURRENT_TIMESTAMP,
	[Mensaje]   [varchar](max)         NOT NULL,
	[UsuarioID] [bigint]               NOT NULL,
	CONSTRAINT [PK_AuditoriaErrores] PRIMARY KEY CLUSTERED ([ErrorID] ASC),
	CONSTRAINT [FK_Error_Usuario] FOREIGN KEY ([UsuarioID]) REFERENCES [dbo].[TBL_Usuarios]([UsuarioID])
);
