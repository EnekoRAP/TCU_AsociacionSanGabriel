CREATE OR REPLACE PROCEDURE SP_REGISTRAR_ERROR (
	P_MENSAJE IN VARCHAR2,
	P_ORIGEN IN VARCHAR2,
	P_ID_USUARIO IN NUMBER
) AS
BEGIN
	INSERT INTO TBL_AUDITORIA_ERRORES (MENSAJE, ORIGEN, ID_USUARIO)
	VALUES (P_MENSAJE, P_ORIGEN, P_ID_USUARIO);
END;
