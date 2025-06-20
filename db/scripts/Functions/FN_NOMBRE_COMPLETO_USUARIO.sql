CREATE OR REPLACE FUNCTION FN_NOMBRE_COMPLETO_USUARIO (
	P_ID_USUARIO IN NUMBER
) RETURN VARCHAR2 IS
	V_QUERY VARCHAR2(1000);
	V_NOMBRE_COMPLETO VARCHAR2(150);
BEGIN
	V_QUERY := 'SELECT NOMBRE || '' '' || APELLIDOS FROM TBL_USUARIOS WHERE ID_USUARIO = :1';
	
	EXECUTE IMMEDIATE V_QUERY INTO V_NOMBRE_COMPLETO USING P_ID_USUARIO;
	
	RETURN V_NOMBRE_COMPLETO;
END;
