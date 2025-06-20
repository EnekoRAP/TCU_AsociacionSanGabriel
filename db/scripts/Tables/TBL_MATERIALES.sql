CREATE TABLE TBL_MATERIALES (
	ID_MATERIAL NUMBER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
	NOMBRE VARCHAR2(50) NOT NULL,
	TIPO VARCHAR2(50) NOT NULL,
	CANTIDAD NUMBER NOT NULL,
	ESTADO NUMBER(1),
	ID_ASIGNATURA NUMBER,
	CONSTRAINT FK_MATERIAL_ASIGNATURA FOREIGN KEY (ID_ASIGNATURA) REFERENCES TBL_ASIGNATURAS(ID_ASIGNATURA)
);
