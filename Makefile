.PHONY: site pdf disparar dry-run

# Iniciar servidor de desenvolvimento
site:
	@cd site && php artisan serve

# Gerar currículo em PDF
pdf:
	@php scripts/gerar-curriculo.php

# Disparar currículo para lista de emails (modo simulação)
dry-run:
	@cd site && php artisan curriculo:disparar --dry-run

# Disparar currículo para lista de emails (envio real)
disparar:
	@cd site && php artisan curriculo:disparar
