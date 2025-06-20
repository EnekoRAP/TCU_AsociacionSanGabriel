CREATE OR REPLACE TRIGGER TRG_AUTOREGISTRO_BITACORA_ERRORES
AFTER INSERT ON TBL_AUDITORIA_ERRORES
FOR EACH ROW
BEGIN
	INSERT INTO TBL_BITACORAS (ACCION, ID_USUARIO)
	VALUES (
		'Se registrÃ³ un error: ' || :NEW.MENSAJE || ' | Origen: ' || :NEW.ORIGEN,
		:NEW.ID_USUARIO
	);
END;
