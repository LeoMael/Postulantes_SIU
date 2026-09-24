<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Postulantes - SIU SUNEDU | UNAP</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1e3a8a;
            --primary-dark: #0f172a;
            --primary-light: #2563eb;
            --accent: #b45309;
            --success: #059669;
            --bg-body: #f1f5f9;
            --card-bg: #ffffff;
            --border-color: #cbd5e1;
            --border-subtle: #e2e8f0;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --shadow-xs: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-sm: 0 2px 4px rgb(0 0 0 / 0.06);
            --radius-sm: 6px;
            --radius-md: 8px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            line-height: 1.45;
            -webkit-font-smoothing: antialiased;
        }

        /* Cabecera reducida y limpia (Sin forma de pila ni badges pesados) */
        header.app-header {
            background-color: #0f172a;
            color: #ffffff;
            padding: 0.65rem 1.5rem;
            border-bottom: 2px solid #1e3a8a;
        }

        .header-container {
            max-width: 100%;
            padding: 0 0.5rem;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand-titles h1 {
            font-size: 1.05rem;
            font-weight: 700;
            color: #f8fafc;
            letter-spacing: -0.01em;
        }

        .brand-titles p {
            font-size: 0.76rem;
            color: #94a3b8;
        }

        .header-subtext {
            font-size: 0.8rem;
            color: #cbd5e1;
            font-weight: 500;
        }

        .header-user-nav {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .header-account {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.825rem;
            color: #cbd5e1;
        }

        .header-user-icon {
            color: #94a3b8;
            flex-shrink: 0;
        }

        .account-name {
            color: #ffffff;
            font-weight: 700;
        }

        .account-role-text {
            color: #93c5fd;
            font-size: 0.785rem;
            font-weight: 500;
        }

        .header-divider {
            width: 1px;
            height: 20px;
            background: rgba(255, 255, 255, 0.18);
        }

        .btn-header-admin {
            background-color: #2563eb;
            border: 1px solid #3b82f6;
            color: #ffffff;
            padding: 0.42rem 0.9rem;
            border-radius: 4px;
            font-size: 0.785rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            transition: all 0.12s ease;
        }

        .btn-header-admin:hover {
            background-color: #1d4ed8;
            border-color: #60a5fa;
        }

        .btn-header-logout {
            background-color: #dc2626;
            border: 1px solid #b91c1c;
            color: #ffffff;
            padding: 0.42rem 0.85rem;
            border-radius: 4px;
            font-size: 0.785rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: all 0.12s ease;
        }

        .btn-header-logout:hover {
            background-color: #b91c1c;
            border-color: #991b1b;
            color: #ffffff;
        }

        /* Modal de Gestión de Usuarios (Amplio, Espacioso e Institucional) */
        .modal-card.modal-lg {
            max-width: 960px;
            width: 95%;
            max-height: 90vh;
        }

        .modal-tabs {
            display: flex;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 1.75rem;
            gap: 0.75rem;
            background: #f8fafc;
        }

        .modal-tab-btn {
            padding: 0.85rem 1.4rem;
            font-size: 0.86rem;
            font-weight: 600;
            color: #64748b;
            background: transparent;
            border: none;
            border-bottom: 2px solid transparent;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.12s ease;
        }

        .modal-tab-btn:hover {
            color: var(--primary);
        }

        .modal-tab-btn.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
            font-weight: 700;
        }

        .user-mgmt-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .user-mgmt-table th {
            text-align: left;
            padding: 0.85rem 1.25rem;
            background-color: #f8fafc;
            color: #475569;
            font-weight: 700;
            border-bottom: 2px solid #e2e8f0;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .user-mgmt-table td {
            padding: 0.95rem 1.25rem;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            vertical-align: middle;
        }

        .user-mgmt-table tr:hover {
            background-color: #f8fafc;
        }

        .user-role-badge {
            font-size: 0.75rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 4px;
            letter-spacing: 0.2px;
            display: inline-block;
        }

        .role-admin {
            background-color: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .role-operador {
            background-color: #eff6ff;
            color: #1e40af;
            border: 1px solid #bfdbfe;
        }

        .user-status-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 4px;
        }

        .status-active {
            background-color: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .status-inactive {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .user-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-user-action {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 6px 11px;
            font-size: 0.77rem;
            font-weight: 600;
            color: #334155;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            transition: all 0.12s ease;
        }

        .btn-user-action:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
            color: var(--text-main);
        }

        .btn-user-action.danger:hover {
            background: #fee2e2;
            border-color: #fca5a5;
            color: #dc2626;
        }

        .user-form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.35rem;
            padding: 1.75rem;
        }

        /* Contenedor principal aprovechando la pantalla completa */
        main.main-content {
            max-width: 100%;
            margin: 0.65rem auto;
            padding: 0 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        /* Tarjeta general */
        .card {
            background-color: var(--card-bg);
            border-radius: var(--radius-md);
            border: 1px solid var(--border-subtle);
            box-shadow: var(--shadow-xs);
        }

        /* Buscador Global Prominente (DNI, Nombre o Carrera) */
        .global-search-container {
            padding: 0.85rem 1.15rem;
            display: flex;
            gap: 0.65rem;
            align-items: center;
            background-color: #ffffff;
        }

        .search-input-wrapper {
            position: relative;
            flex: 1;
        }

        .search-icon {
            position: absolute;
            left: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }

        .search-input-wrapper input {
            width: 100%;
            padding: 0.6rem 0.85rem 0.6rem 2.5rem;
            font-size: 0.9rem;
            font-family: inherit;
            border: 1.5px solid #cbd5e1;
            border-radius: var(--radius-sm);
            background-color: #f8fafc;
            color: var(--text-main);
            transition: all 0.15s ease;
        }

        .search-input-wrapper input:focus {
            background-color: #ffffff;
            border-color: var(--primary-light);
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        /* Botones */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            padding: 0.55rem 1rem;
            border-radius: var(--radius-sm);
            font-size: 0.835rem;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.12s ease;
            white-space: nowrap;
        }

        .btn-primary {
            background-color: var(--primary);
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }

        .btn-secondary {
            background-color: #ffffff;
            color: #475569;
            border-color: #cbd5e1;
        }

        .btn-secondary:hover {
            background-color: #f8fafc;
            color: var(--text-main);
        }

        /* Panel de Filtros */
        .filter-header {
            padding: 0.65rem 1.15rem;
            background-color: #f8fafc;
            border-bottom: 1px solid var(--border-subtle);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .filter-title {
            font-size: 0.835rem;
            font-weight: 700;
            color: #334155;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .filter-grid {
            padding: 1rem 1.15rem;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
            gap: 0.75rem 0.9rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .form-group.col-span-2 {
            grid-column: span 2;
        }

        @media (max-width: 768px) {
            .form-group.col-span-2 {
                grid-column: span 1;
            }
        }

        .form-group label {
            font-size: 0.735rem;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.2px;
        }

        .form-control {
            width: 100%;
            padding: 0.45rem 0.65rem;
            font-size: 0.825rem;
            font-family: inherit;
            color: var(--text-main);
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: var(--radius-sm);
            outline: none;
            transition: border-color 0.15s ease;
        }

        .form-control:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.12);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.6rem center;
            background-size: 0.85rem;
            padding-right: 1.8rem;
        }

        /* Rango de Fechas Armonioso y Compacto */
        .unified-date-picker {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 35px;
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: var(--radius-sm);
            padding: 0 0.55rem;
            transition: all 0.15s ease;
            box-sizing: border-box;
            gap: 0.35rem;
        }

        .unified-date-picker:hover {
            border-color: #94a3b8;
        }

        .unified-date-picker:focus-within {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
        }

        .date-side {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            flex: 1;
            min-width: 0;
        }

        .date-sublabel {
            font-size: 0.69rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.2px;
            user-select: none;
            flex-shrink: 0;
        }

        .date-field-clean {
            border: none;
            background: transparent;
            font-size: 0.79rem;
            color: var(--text-main);
            font-family: inherit;
            font-weight: 600;
            outline: none;
            width: 100%;
            padding: 0;
            cursor: pointer;
        }

        .date-arrow {
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            padding: 0 0.15rem;
        }

        /* Switch para Ingresantes */
        .switch-toggle {
            display: flex;
            align-items: center;
            background-color: #f1f5f9;
            border: 1px solid #cbd5e1;
            border-radius: var(--radius-sm);
            padding: 2px;
            gap: 2px;
            height: 35px;
            box-sizing: border-box;
            transition: all 0.15s ease;
        }

        .switch-toggle:hover {
            border-color: #94a3b8;
        }

        .switch-opt {
            flex: 1;
            height: 100%;
            border: none;
            background: transparent;
            font-size: 0.76rem;
            font-weight: 600;
            color: #64748b;
            border-radius: 3px;
            cursor: pointer;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            padding: 0 4px;
            user-select: none;
        }

        .switch-opt:hover {
            color: var(--text-main);
        }

        .switch-opt.active {
            background-color: #ffffff;
            color: var(--primary);
            font-weight: 700;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08), 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .switch-opt.active[data-val="SI"] {
            background-color: #ecfdf5;
            color: #059669;
            box-shadow: 0 1px 3px rgba(5, 150, 105, 0.18);
        }

        .switch-opt.active[data-val="NO"] {
            background-color: #fef2f2;
            color: #dc2626;
            box-shadow: 0 1px 3px rgba(220, 38, 38, 0.18);
        }

        /* Selects Personalizados (UI Unificada con Efecto Hover) */
        .label-with-count {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.15rem;
        }

        .options-count-badge {
            font-size: 0.68rem;
            font-weight: 700;
            color: #2563eb;
            background-color: #eff6ff;
            border: 1px solid #dbeafe;
            padding: 1px 7px;
            border-radius: 999px;
        }

        .searchable-select,
        .custom-select {
            position: relative;
            width: 100%;
        }

        .searchable-select-trigger,
        .custom-select-trigger {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
            padding: 0.45rem 0.65rem;
            font-size: 0.825rem;
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: all 0.15s ease;
            user-select: none;
            height: 35px;
            box-sizing: border-box;
        }

        .searchable-select-trigger:hover,
        .custom-select-trigger:hover {
            border-color: #94a3b8;
        }

        .searchable-select-trigger.active,
        .custom-select-trigger.active {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
        }

        .trigger-icon {
            font-size: 0.85rem;
            flex-shrink: 0;
            color: var(--primary);
        }

        .trigger-text {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: var(--text-main);
            font-weight: 600;
            font-size: 0.815rem;
        }

        .trigger-text.placeholder {
            color: #94a3b8;
            font-weight: 500;
        }

        .trigger-actions {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            flex-shrink: 0;
        }

        .btn-clear-choice {
            border: none;
            background: transparent;
            color: #94a3b8;
            font-size: 0.75rem;
            font-weight: bold;
            cursor: pointer;
            padding: 2px 4px;
            border-radius: 3px;
            line-height: 1;
            transition: all 0.1s ease;
        }

        .btn-clear-choice:hover {
            color: #ef4444;
            background-color: #fee2e2;
        }

        .trigger-chevron {
            color: #64748b;
            transition: transform 0.15s ease;
        }

        .searchable-select-trigger.active .trigger-chevron,
        .custom-select-trigger.active .trigger-chevron {
            transform: rotate(180deg);
        }

        .searchable-select-dropdown,
        .custom-select-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            width: 100%;
            min-width: 160px;
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: var(--radius-md);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15), 0 8px 10px -6px rgba(0, 0, 0, 0.08);
            z-index: 100;
            overflow: hidden;
            animation: fadeInModal 0.12s ease;
        }

        .searchable-select-dropdown.show,
        .custom-select-dropdown.show {
            display: block;
        }

        .searchable-search-wrapper {
            padding: 0.5rem 0.65rem;
            border-bottom: 1px solid var(--border-subtle);
            background-color: #f8fafc;
            display: flex;
            align-items: center;
            gap: 0.45rem;
        }

        .searchable-search-wrapper svg {
            color: #94a3b8;
            flex-shrink: 0;
        }

        .searchable-search-input {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 0.35rem 0.55rem;
            font-size: 0.8rem;
            outline: none;
            font-family: inherit;
            transition: all 0.12s ease;
        }

        .searchable-search-input:focus {
            border-color: var(--primary-light);
            background-color: #ffffff;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
        }

        .searchable-filter-hint {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.4rem 0.75rem;
            font-size: 0.72rem;
            background-color: #eff6ff;
            border-bottom: 1px solid #dbeafe;
            color: #1e40af;
        }

        .btn-reset-filter {
            border: none;
            background: transparent;
            color: #2563eb;
            font-weight: 700;
            font-size: 0.7rem;
            text-decoration: underline;
            cursor: pointer;
        }

        .searchable-options-list,
        .custom-select-options-list {
            max-height: 230px;
            overflow-y: auto;
            padding: 0.25rem 0;
        }

        .searchable-option,
        .custom-select-option {
            display: flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.42rem 0.75rem;
            font-size: 0.8rem;
            color: #1e293b;
            cursor: pointer;
            transition: background-color 0.1s ease;
            border-left: 3px solid transparent;
        }

        .searchable-option:hover,
        .custom-select-option:hover {
            background-color: #f1f5f9;
            border-left-color: var(--primary-light);
        }

        .searchable-option.selected,
        .custom-select-option.selected {
            background-color: #eff6ff;
            color: var(--primary);
            font-weight: 700;
            border-left-color: var(--primary);
        }

        .searchable-option.all-option,
        .custom-select-option.all-option {
            font-style: italic;
            border-bottom: 1px solid #f1f5f9;
            color: #64748b;
        }

        .option-check {
            width: 14px;
            height: 14px;
            color: var(--primary);
            flex-shrink: 0;
            margin-top: 1px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            visibility: hidden;
        }

        .searchable-option.selected .option-check,
        .custom-select-option.selected .option-check {
            visibility: visible;
        }

        .option-content {
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
            flex: 1;
            min-width: 0;
        }

        .option-title {
            line-height: 1.25;
            word-break: break-word;
        }

        .option-subtitle {
            font-size: 0.7rem;
            color: #64748b;
            font-weight: 500;
        }

        .searchable-no-results {
            padding: 1.25rem 0.75rem;
            text-align: center;
            font-size: 0.785rem;
            color: #94a3b8;
        }

        /* Quick Filter Tags */
        .quick-filters {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1.15rem;
            background-color: #f8fafc;
            border-top: 1px solid var(--border-subtle);
            flex-wrap: wrap;
        }

        .quick-filters-label {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.72rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .quick-divider {
            color: #cbd5e1;
            margin: 0 0.25rem;
            font-size: 0.75rem;
        }

        .quick-tag {
            font-size: 0.74rem;
            font-weight: 600;
            padding: 0.25rem 0.65rem;
            border: 1px solid #cbd5e1;
            background-color: #ffffff;
            border-radius: var(--radius-sm);
            color: #475569;
            cursor: pointer;
            transition: all 0.12s ease;
        }

        .quick-tag:hover {
            border-color: var(--primary-light);
            color: var(--primary);
        }

        .quick-tag.active {
            background-color: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
        }

        .btn-close-modal {
            background: transparent;
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-sm);
            width: 28px;
            height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .btn-close-modal:hover {
            background-color: #fee2e2;
            border-color: #fca5a5;
            color: #dc2626;
        }

        /* Barra de Estadísticas Compacta */
        .stats-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.75rem;
            padding: 0.15rem 0;
            font-size: 0.825rem;
        }

        .stats-left {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            color: #334155;
            font-weight: 600;
        }

        .stat-highlight {
            color: var(--primary);
            font-weight: 800;
            font-size: 0.95rem;
        }

        .table-controls {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        /* Botón y Menú de Exportación */
        .export-dropdown-wrapper {
            position: relative;
            display: inline-block;
        }

        .btn-export {
            background-color: #059669;
            color: #ffffff;
            border: 1px solid #047857;
            padding: 0.38rem 0.85rem;
            font-size: 0.815rem;
            border-radius: var(--radius-sm);
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .btn-export:hover {
            background-color: #047857;
            box-shadow: 0 2px 4px rgba(5, 150, 105, 0.25);
        }

        .export-menu {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 4px);
            background: #ffffff;
            min-width: 250px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            border: 1px solid #cbd5e1;
            border-radius: var(--radius-md);
            padding: 0.35rem 0;
            z-index: 50;
            animation: fadeInExport 0.15s ease-out;
        }

        .export-menu.show {
            display: block;
        }

        @keyframes fadeInExport {
            from { opacity: 0; transform: translateY(-4px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .export-menu-item {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.6rem 0.95rem;
            text-decoration: none;
            color: var(--text-main);
            transition: background-color 0.12s ease;
            cursor: pointer;
        }

        .export-menu-item:hover {
            background-color: #f1f5f9;
        }

        .export-badge {
            font-size: 0.68rem;
            font-weight: 800;
            padding: 2px 6px;
            border-radius: 4px;
            letter-spacing: 0.3px;
        }

        .export-badge-excel {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .export-badge-csv {
            background-color: #e0f2fe;
            color: #0369a1;
            border: 1px solid #bae6fd;
        }

        .export-title {
            font-size: 0.825rem;
            font-weight: 700;
            color: #1e293b;
        }

        .export-desc {
            font-size: 0.71rem;
            color: #64748b;
        }

        /* Contenedor de Carga 0% a 100% y Cancelar Exportación */
        .export-progress-box {
            position: relative;
            display: inline-flex;
            align-items: center;
            height: 31px;
            min-width: 215px;
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: var(--radius-sm);
            overflow: hidden;
            box-sizing: border-box;
            user-select: none;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            animation: fadeInExport 0.15s ease-out;
        }

        .export-progress-bar-fill {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 0%;
            background: linear-gradient(90deg, #dbeafe 0%, #bfdbfe 100%);
            border-right: 1px solid #93c5fd;
            transition: width 0.15s ease, background 0.2s ease;
            z-index: 1;
        }

        .export-progress-bar-fill.success {
            background: linear-gradient(90deg, #dcfce7 0%, #bbf7d0 100%);
            border-right-color: #86efac;
        }

        .export-progress-bar-fill.cancelled {
            background: #f1f5f9;
            border-right: none;
        }

        .export-progress-info {
            position: relative;
            z-index: 2;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 0.45rem;
            gap: 0.35rem;
        }

        .export-progress-status {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            min-width: 0;
        }

        .export-spinner {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            flex-shrink: 0;
        }

        .export-spinner.success {
            color: #16a34a;
        }

        .spin-icon {
            animation: spin 1s linear infinite;
        }

        .export-format-badge {
            font-size: 0.65rem;
            font-weight: 800;
            padding: 1px 4px;
            border-radius: 3px;
            letter-spacing: 0.2px;
            line-height: 1.1;
        }

        .export-format-badge.xlsx {
            background-color: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .export-format-badge.csv {
            background-color: #e0f2fe;
            color: #0369a1;
            border: 1px solid #bae6fd;
        }

        .export-pct-text {
            font-size: 0.74rem;
            font-weight: 700;
            color: #1e293b;
            font-variant-numeric: tabular-nums;
            white-space: nowrap;
        }

        .btn-cancel-export {
            display: inline-flex;
            align-items: center;
            gap: 0.2rem;
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 3px;
            padding: 2px 6px;
            font-size: 0.68rem;
            font-weight: 700;
            color: #ef4444;
            cursor: pointer;
            line-height: 1.2;
            transition: all 0.15s ease;
            flex-shrink: 0;
        }

        .btn-cancel-export:hover {
            background-color: #fef2f2;
            border-color: #fca5a5;
            color: #dc2626;
        }

        /* Tabla de Resultados */
        .results-card {
            background-color: var(--card-bg);
            border-radius: var(--radius-md);
            border: 1px solid var(--border-subtle);
            box-shadow: var(--shadow-xs);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            position: relative;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.815rem;
        }

        table.data-table thead tr {
            background-color: var(--primary);
            color: #ffffff;
            border-bottom: 2px solid #0f172a;
        }

        table.data-table th {
            padding: 0.65rem 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.73rem;
            letter-spacing: 0.4px;
            white-space: nowrap;
            color: #ffffff;
            background-color: var(--primary);
            border-right: 1px solid rgba(255, 255, 255, 0.14);
            position: sticky;
            top: 0;
            z-index: 5;
        }

        table.data-table th:last-child {
            border-right: none;
        }

        table.data-table tbody tr {
            border-bottom: 1px solid var(--border-subtle);
            transition: background-color 0.1s ease;
        }

        table.data-table tbody tr:hover {
            background-color: #f8fafc;
        }

        table.data-table td {
            padding: 0.55rem 0.75rem;
            color: #1e293b;
            vertical-align: middle;
        }

        .badge {
            display: inline-block;
            padding: 0.15rem 0.45rem;
            border-radius: 4px;
            font-size: 0.72rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-muted {
            background-color: #f1f5f9;
            color: #475569;
        }

        .badge-process {
            background-color: #e0f2fe;
            color: #0369a1;
            font-weight: 700;
        }

        .doc-dni {
            font-family: monospace;
            font-weight: 700;
            color: var(--primary-dark);
            background: #f1f5f9;
            padding: 2px 5px;
            border-radius: 3px;
        }

        /* Overlay de carga */
        .loading-overlay {
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.85);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            z-index: 10;
        }

        .spinner {
            width: 26px;
            height: 26px;
            border: 3px solid #e2e8f0;
            border-top: 3px solid var(--primary);
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Paginación */
        .pagination-container {
            padding: 0.65rem 1.15rem;
            background-color: #f8fafc;
            border-top: 1px solid var(--border-subtle);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .page-info {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .pagination-buttons {
            display: flex;
            gap: 0.25rem;
            align-items: center;
        }

        .page-btn {
            background-color: #ffffff;
            border: 1px solid var(--border-color);
            color: var(--text-main);
            min-width: 30px;
            height: 30px;
            border-radius: var(--radius-sm);
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            padding: 0 0.4rem;
        }

        .page-btn:hover:not(:disabled) {
            background-color: #f1f5f9;
        }

        .page-btn.active {
            background-color: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
        }

        .page-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* Modal de Ficha Detallada */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(2px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 100;
            padding: 1rem;
        }

        .modal-card {
            background: #ffffff;
            border-radius: var(--radius-md);
            max-width: 760px;
            width: 100%;
            max-height: 88vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.25);
            overflow: hidden;
            animation: fadeInModal 0.15s ease;
        }

        @keyframes fadeInModal {
            from { opacity: 0; transform: scale(0.97); }
            to { opacity: 1; transform: scale(1); }
        }

        .modal-header {
            padding: 0.85rem 1.25rem;
            border-bottom: 1px solid var(--border-subtle);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f8fafc;
        }

        .modal-header h3 {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .modal-body {
            padding: 1.25rem;
            overflow-y: auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
            gap: 0.85rem 1.15rem;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
        }

        .detail-label {
            font-size: 0.7rem;
            color: var(--text-muted);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .detail-val {
            font-size: 0.835rem;
            color: var(--text-main);
            font-weight: 600;
            word-break: break-word;
        }

        .modal-footer {
            padding: 0.65rem 1.25rem;
            border-top: 1px solid var(--border-subtle);
            display: flex;
            justify-content: flex-end;
            background-color: #f8fafc;
        }
    </style>
</head>
<body>

    <!-- Cabecera Reducida y Limpia -->
    <header class="app-header">
        <div class="header-container">
            <div class="brand-titles">
                <h1>Universidad Nacional del Altiplano - Puno</h1>
                <p>Sistema Integrado SIU - SUNEDU | Módulo de Postulantes</p>
            </div>
            <div class="header-user-nav">
                @if(Auth::check())
                    <div class="header-account">
                        <svg class="header-user-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span class="account-name">{{ Auth::user()->name }}</span>
                        <span class="account-role-text">({{ Auth::user()->isAdmin() ? 'Administrador' : 'Operador' }})</span>
                    </div>

                    <span class="header-divider"></span>

                    @if(Auth::user()->isAdmin())
                        <button type="button" class="btn-header-admin" onclick="abrirModalUsuarios()" title="Gestionar Usuarios del Sistema">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span>Gestión de Usuarios</span>
                        </button>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" style="display: inline; margin: 0;" onsubmit="return confirm('¿Está seguro de que desea cerrar sesión en el sistema?');">
                        @csrf
                        <button type="submit" class="btn-header-logout" title="Cerrar Sesión Segura">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            <span>Cerrar Sesión</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="main-content">

        <!-- Buscador Global Prominente (DNI, Nombre o Carrera) -->
        <div class="card global-search-container">
            <div class="search-input-wrapper">
                <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" id="search_global" placeholder="Buscador inteligente: Escribe DNI, nombres del postulante o nombre de la carrera / programa y presiona Enter..." onkeydown="if(event.key==='Enter') buscarPostulantes(1)">
            </div>
            <button type="button" class="btn btn-primary" onclick="buscarPostulantes(1)">
                Buscar
            </button>
            <button type="button" class="btn btn-secondary" onclick="limpiarFiltros()">
                Limpiar Todo
            </button>
        </div>

        <!-- Panel de Filtros Específicos -->
        <div class="card">
            <div class="filter-header">
                <div class="filter-title">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                    </svg>
                    Filtros Detallados
                </div>
                <div style="font-size: 0.75rem; color: var(--text-muted);">
                    Selecciona uno o más criterios
                </div>
            </div>

            <div class="filter-grid" id="form-filtros">
                <!-- 1. Sede / Filial -->
                <div class="form-group">
                    <label for="filial">Sede / Filial</label>
                    <input type="hidden" id="filial" name="filial" value="">
                    <div class="custom-select" id="select-wrapper-filial">
                        <div class="custom-select-trigger" id="trigger-filial" onclick="toggleCustomSelect('filial', event)">
                            <span class="trigger-text placeholder" id="text-filial" data-default="--seleccione--">--seleccione--</span>
                            <div class="trigger-actions">
                                <button type="button" class="btn-clear-choice" id="btn-clear-filial" style="display:none;" onclick="clearCustomChoice('filial', event)" title="Limpiar filial">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </button>
                                <svg class="trigger-chevron" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                        </div>
                        <div class="custom-select-dropdown" id="dropdown-filial">
                            <div class="custom-select-options-list" id="list-filial">
                                <div class="custom-select-option all-option selected" data-value="" onclick="selectCustomOption('filial', '', '--seleccione--')">
                                    <span class="option-check">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span class="option-title">--seleccione--</span>
                                </div>
                                @foreach($filiales as $filial)
                                    <div class="custom-select-option" data-value="{{ $filial }}" onclick="selectCustomOption('filial', '{{ addslashes($filial) }}', '{{ addslashes($filial) }}')">
                                        <span class="option-check">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        </span>
                                        <span class="option-title">{{ $filial }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Nivel Académico -->
                <div class="form-group">
                    <label for="nivel_academico">Nivel Académico</label>
                    <input type="hidden" id="nivel_academico" name="nivel_academico" value="">
                    <div class="custom-select" id="select-wrapper-nivel_academico">
                        <div class="custom-select-trigger" id="trigger-nivel_academico" onclick="toggleCustomSelect('nivel_academico', event)">
                            <span class="trigger-text placeholder" id="text-nivel_academico" data-default="--seleccione--">--seleccione--</span>
                            <div class="trigger-actions">
                                <button type="button" class="btn-clear-choice" id="btn-clear-nivel_academico" style="display:none;" onclick="clearCustomChoice('nivel_academico', event)" title="Limpiar nivel">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </button>
                                <svg class="trigger-chevron" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                        </div>
                        <div class="custom-select-dropdown" id="dropdown-nivel_academico">
                            <div class="custom-select-options-list" id="list-nivel_academico">
                                <div class="custom-select-option all-option selected" data-value="" onclick="selectCustomOption('nivel_academico', '', '--seleccione--')">
                                    <span class="option-check">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span class="option-title">--seleccione--</span>
                                </div>
                                @foreach($niveles as $nivel)
                                    <div class="custom-select-option" data-value="{{ $nivel }}" onclick="selectCustomOption('nivel_academico', '{{ addslashes($nivel) }}', '{{ addslashes($nivel) }}')">
                                        <span class="option-check">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        </span>
                                        <span class="option-title">{{ $nivel }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Tipo Proceso de Admisión -->
                <div class="form-group">
                    <label for="tipo_proceso">Tipo Proceso de Admisión</label>
                    <input type="hidden" id="tipo_proceso" name="tipo_proceso" value="">
                    <div class="custom-select" id="select-wrapper-tipo_proceso">
                        <div class="custom-select-trigger" id="trigger-tipo_proceso" onclick="toggleCustomSelect('tipo_proceso', event)">
                            <span class="trigger-text placeholder" id="text-tipo_proceso" data-default="--seleccione--">--seleccione--</span>
                            <div class="trigger-actions">
                                <button type="button" class="btn-clear-choice" id="btn-clear-tipo_proceso" style="display:none;" onclick="clearCustomChoice('tipo_proceso', event)" title="Limpiar tipo proceso">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </button>
                                <svg class="trigger-chevron" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                        </div>
                        <div class="custom-select-dropdown" id="dropdown-tipo_proceso">
                            <div class="custom-select-options-list" id="list-tipo_proceso">
                                <div class="custom-select-option all-option selected" data-value="" onclick="selectCustomOption('tipo_proceso', '', '--seleccione--')">
                                    <span class="option-check">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span class="option-title">--seleccione--</span>
                                </div>
                                @foreach($tiposProceso as $tp)
                                    <div class="custom-select-option" data-value="{{ $tp }}" onclick="selectCustomOption('tipo_proceso', '{{ addslashes($tp) }}', '{{ addslashes($tp) }}')">
                                        <span class="option-check">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        </span>
                                        <span class="option-title">{{ $tp }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Proceso de Admisión - Año -->
                <div class="form-group">
                    <label for="proceso_anio">Proceso de Admisión - Año</label>
                    <input type="hidden" id="proceso_anio" name="proceso_anio" value="">
                    <div class="custom-select" id="select-wrapper-proceso_anio">
                        <div class="custom-select-trigger" id="trigger-proceso_anio" onclick="toggleCustomSelect('proceso_anio', event)">
                            <span class="trigger-text placeholder" id="text-proceso_anio" data-default="--todos--">--todos--</span>
                            <div class="trigger-actions">
                                <button type="button" class="btn-clear-choice" id="btn-clear-proceso_anio" style="display:none;" onclick="clearCustomChoice('proceso_anio', event)" title="Limpiar año">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </button>
                                <svg class="trigger-chevron" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                        </div>
                        <div class="custom-select-dropdown" id="dropdown-proceso_anio">
                            <div class="custom-select-options-list" id="list-proceso_anio">
                                <div class="custom-select-option all-option selected" data-value="" onclick="selectCustomOption('proceso_anio', '', '--todos--')">
                                    <span class="option-check">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span class="option-title">--todos--</span>
                                </div>
                                @foreach($anios as $anio)
                                    <div class="custom-select-option" data-value="{{ $anio }}" onclick="selectCustomOption('proceso_anio', '{{ addslashes($anio) }}', '{{ addslashes($anio) }}')">
                                        <span class="option-check">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        </span>
                                        <span class="option-title">{{ $anio }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5. Proceso de Admisión - Número -->
                <div class="form-group">
                    <label for="proceso_num">Proceso de Admisión - Número</label>
                    <input type="hidden" id="proceso_num" name="proceso_num" value="">
                    <div class="custom-select" id="select-wrapper-proceso_num">
                        <div class="custom-select-trigger" id="trigger-proceso_num" onclick="toggleCustomSelect('proceso_num', event)">
                            <span class="trigger-text placeholder" id="text-proceso_num" data-default="--todos--">--todos--</span>
                            <div class="trigger-actions">
                                <button type="button" class="btn-clear-choice" id="btn-clear-proceso_num" style="display:none;" onclick="clearCustomChoice('proceso_num', event)" title="Limpiar número">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </button>
                                <svg class="trigger-chevron" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                        </div>
                        <div class="custom-select-dropdown" id="dropdown-proceso_num">
                            <div class="custom-select-options-list" id="list-proceso_num">
                                <div class="custom-select-option all-option selected" data-value="" onclick="selectCustomOption('proceso_num', '', '--todos--')">
                                    <span class="option-check">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span class="option-title">--todos--</span>
                                </div>
                                @foreach($numerosProceso as $num)
                                    <div class="custom-select-option" data-value="{{ $num }}" onclick="selectCustomOption('proceso_num', '{{ addslashes($num) }}', '{{ addslashes($num) }}')">
                                        <span class="option-check">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        </span>
                                        <span class="option-title">{{ $num }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 6. Número Convocatoria -->
                <div class="form-group">
                    <label for="numero_convocatoria">Número Convocatoria</label>
                    <input type="hidden" id="numero_convocatoria" name="numero_convocatoria" value="">
                    <div class="custom-select" id="select-wrapper-numero_convocatoria">
                        <div class="custom-select-trigger" id="trigger-numero_convocatoria" onclick="toggleCustomSelect('numero_convocatoria', event)">
                            <span class="trigger-text placeholder" id="text-numero_convocatoria" data-default="--seleccione--">--seleccione--</span>
                            <div class="trigger-actions">
                                <button type="button" class="btn-clear-choice" id="btn-clear-numero_convocatoria" style="display:none;" onclick="clearCustomChoice('numero_convocatoria', event)" title="Limpiar convocatoria">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </button>
                                <svg class="trigger-chevron" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                        </div>
                        <div class="custom-select-dropdown" id="dropdown-numero_convocatoria">
                            <div class="custom-select-options-list" id="list-numero_convocatoria">
                                <div class="custom-select-option all-option selected" data-value="" onclick="selectCustomOption('numero_convocatoria', '', '--seleccione--')">
                                    <span class="option-check">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span class="option-title">--seleccione--</span>
                                </div>
                                @foreach($convocatorias as $conv)
                                    <div class="custom-select-option" data-value="{{ $conv }}" onclick="selectCustomOption('numero_convocatoria', '{{ addslashes($conv) }}', '{{ addslashes($conv) }}')">
                                        <span class="option-check">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        </span>
                                        <span class="option-title">{{ $conv }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 7. Fecha de Convocatoria -->
                <div class="form-group">
                    <label for="fecha_convocatorias">Fecha de Convocatoria</label>
                    <input type="hidden" id="fecha_convocatorias" name="fecha_convocatorias" value="">
                    <div class="custom-select" id="select-wrapper-fecha_convocatorias">
                        <div class="custom-select-trigger" id="trigger-fecha_convocatorias" onclick="toggleCustomSelect('fecha_convocatorias', event)">
                            <span class="trigger-text placeholder" id="text-fecha_convocatorias" data-default="--seleccione--">--seleccione--</span>
                            <div class="trigger-actions">
                                <button type="button" class="btn-clear-choice" id="btn-clear-fecha_convocatorias" style="display:none;" onclick="clearCustomChoice('fecha_convocatorias', event)" title="Limpiar fecha">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </button>
                                <svg class="trigger-chevron" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                        </div>
                        <div class="custom-select-dropdown" id="dropdown-fecha_convocatorias">
                            <div class="custom-select-options-list" id="list-fecha_convocatorias">
                                <div class="custom-select-option all-option selected" data-value="" onclick="selectCustomOption('fecha_convocatorias', '', '--seleccione--')">
                                    <span class="option-check">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span class="option-title">--seleccione--</span>
                                </div>
                                @foreach($fechasConvocatoria as $fc)
                                    <div class="custom-select-option" data-value="{{ $fc }}" onclick="selectCustomOption('fecha_convocatorias', '{{ addslashes($fc) }}', '{{ addslashes($fc) }}')">
                                        <span class="option-check">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        </span>
                                        <span class="option-title">{{ $fc }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 8. Es Ingresante (Tipo Switch) -->
                <div class="form-group">
                    <label for="es_ingresante">Es Ingresante</label>
                    <input type="hidden" id="es_ingresante" value="">
                    <div class="switch-toggle" id="switch-ingresante" role="group" aria-label="Filtrar por ingresante">
                        <button type="button" class="switch-opt active" data-val="" onclick="setIngresante('', this)">Todos</button>
                        <button type="button" class="switch-opt" data-val="SI" onclick="setIngresante('SI', this)">SÍ</button>
                        <button type="button" class="switch-opt" data-val="NO" onclick="setIngresante('NO', this)">NO</button>
                    </div>
                </div>

                <!-- 9. Modalidad de Admisión -->
                <div class="form-group">
                    <label for="modalidad_ingreso">Modalidad de Admisión</label>
                    <input type="hidden" id="modalidad_ingreso" name="modalidad_ingreso" value="">
                    <div class="custom-select" id="select-wrapper-modalidad_ingreso">
                        <div class="custom-select-trigger" id="trigger-modalidad_ingreso" onclick="toggleCustomSelect('modalidad_ingreso', event)">
                            <span class="trigger-text placeholder" id="text-modalidad_ingreso" data-default="--seleccione--">--seleccione--</span>
                            <div class="trigger-actions">
                                <button type="button" class="btn-clear-choice" id="btn-clear-modalidad_ingreso" style="display:none;" onclick="clearCustomChoice('modalidad_ingreso', event)" title="Limpiar modalidad">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </button>
                                <svg class="trigger-chevron" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                        </div>
                        <div class="custom-select-dropdown" id="dropdown-modalidad_ingreso">
                            <div class="custom-select-options-list" id="list-modalidad_ingreso">
                                <div class="custom-select-option all-option selected" data-value="" onclick="selectCustomOption('modalidad_ingreso', '', '--seleccione--')">
                                    <span class="option-check">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span class="option-title">--seleccione--</span>
                                </div>
                                @foreach($modalidades as $mod)
                                    <div class="custom-select-option" data-value="{{ $mod }}" onclick="selectCustomOption('modalidad_ingreso', '{{ addslashes($mod) }}', '{{ addslashes($mod) }}')">
                                        <span class="option-check">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        </span>
                                        <span class="option-title">{{ $mod }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 10. Ordenar Resultados Por -->
                <div class="form-group">
                    <label for="ordenar_por">Ordenar Por</label>
                    <input type="hidden" id="ordenar_por" name="ordenar_por" value="recientes">
                    <div class="custom-select" id="select-wrapper-ordenar_por">
                        <div class="custom-select-trigger" id="trigger-ordenar_por" onclick="toggleCustomSelect('ordenar_por', event)">
                            <span class="trigger-text" id="text-ordenar_por" data-default="Más recientes primero">Más recientes primero</span>
                            <div class="trigger-actions">
                                <svg class="trigger-chevron" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                        </div>
                        <div class="custom-select-dropdown" id="dropdown-ordenar_por">
                            <div class="custom-select-options-list" id="list-ordenar_por">
                                <div class="custom-select-option selected" data-value="recientes" onclick="selectCustomOption('ordenar_por', 'recientes', 'Más recientes primero')">
                                    <span class="option-check">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span class="option-title">Más recientes primero</span>
                                </div>
                                <div class="custom-select-option" data-value="antiguos" onclick="selectCustomOption('ordenar_por', 'antiguos', 'Más antiguos primero')">
                                    <span class="option-check">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span class="option-title">Más antiguos primero</span>
                                </div>
                                <div class="custom-select-option" data-value="nombre_asc" onclick="selectCustomOption('ordenar_por', 'nombre_asc', 'Postulante (A - Z)')">
                                    <span class="option-check">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span class="option-title">Postulante (A - Z)</span>
                                </div>
                                <div class="custom-select-option" data-value="nombre_desc" onclick="selectCustomOption('ordenar_por', 'nombre_desc', 'Postulante (Z - A)')">
                                    <span class="option-check">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span class="option-title">Postulante (Z - A)</span>
                                </div>
                                <div class="custom-select-option" data-value="carrera_asc" onclick="selectCustomOption('ordenar_por', 'carrera_asc', 'Carrera / Programa (A - Z)')">
                                    <span class="option-check">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span class="option-title">Carrera / Programa (A - Z)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 11. Rango de Fechas de Registro -->
                <div class="form-group col-span-2">
                    <div class="label-with-count">
                        <label for="fecha_inicio">Fecha de Registro (Rango)</label>
                        <button type="button" class="btn-clear-choice" id="btn-clear-fechas" style="display:none;" onclick="limpiarFechasRegistro()" title="Limpiar rango de fechas">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="unified-date-picker">
                        <div class="date-side">
                            <span class="date-sublabel">Desde:</span>
                            <input type="date" id="fecha_inicio" class="date-field-clean" onchange="onDateRangeChange()">
                        </div>
                        <div class="date-arrow">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                        <div class="date-side">
                            <span class="date-sublabel">Hasta:</span>
                            <input type="date" id="fecha_fin" class="date-field-clean" onchange="onDateRangeChange()">
                        </div>
                    </div>
                </div>

                <!-- 12. Facultad / Unidad de Posgrado con Buscador Inteligente -->
                <div class="form-group col-span-2">
                    <div class="label-with-count">
                        <label for="search-unidad">Facultad / Unidad de Posgrado</label>
                        <span class="options-count-badge" id="badge-count-unidad">{{ count($unidades) }} facultades</span>
                    </div>
                    <input type="hidden" id="unidad" name="unidad" value="">
                    <div class="searchable-select" id="select-wrapper-unidad">
                        <div class="searchable-select-trigger" id="trigger-unidad" onclick="toggleSearchableSelect('unidad', event)">
                            <svg class="trigger-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="3" y1="21" x2="21" y2="21"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                <polyline points="3 10 12 4 21 10"></polyline>
                                <line x1="5" y1="10" x2="5" y2="21"></line>
                                <line x1="9" y1="10" x2="9" y2="21"></line>
                                <line x1="15" y1="10" x2="15" y2="21"></line>
                                <line x1="19" y1="10" x2="19" y2="21"></line>
                            </svg>
                            <span class="trigger-text placeholder" id="text-unidad">-- Todas las Facultades / Unidades --</span>
                            <div class="trigger-actions">
                                <button type="button" class="btn-clear-choice" id="btn-clear-unidad" style="display:none;" onclick="clearSearchableChoice('unidad', event)" title="Limpiar facultad">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                                <svg class="trigger-chevron" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                        </div>
                        <div class="searchable-select-dropdown" id="dropdown-unidad">
                            <div class="searchable-search-wrapper">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                <input type="text" class="searchable-search-input" id="search-unidad" placeholder="Buscar facultad o posgrado..." oninput="onFilterSearchable('unidad')">
                            </div>
                            <div class="searchable-options-list" id="list-unidad">
                                <div class="searchable-option all-option selected" data-value="" onclick="selectSearchableOption('unidad', '', '-- Todas las Facultades / Unidades --')">
                                    <span class="option-check">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span class="option-title">-- Todas las Facultades / Unidades --</span>
                                </div>
                                @foreach($unidades as $u)
                                    <div class="searchable-option" data-value="{{ $u }}" onclick="selectSearchableOption('unidad', '{{ addslashes($u) }}', '{{ addslashes($u) }}')">
                                        <span class="option-check">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        </span>
                                        <div class="option-content">
                                            <span class="option-title">{{ $u }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="searchable-no-results" id="no-results-unidad" style="display:none;">
                                No se encontró ninguna facultad con ese nombre
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 13. Programa Primera Opción con Buscador Inteligente -->
                <div class="form-group col-span-2">
                    <div class="label-with-count">
                        <label for="search-programa">Programa Primera Opción (Carrera)</label>
                        <span class="options-count-badge" id="badge-count-programa">{{ count($programas) }} programas</span>
                    </div>
                    <input type="hidden" id="programa" name="programa" value="">
                    <div class="searchable-select" id="select-wrapper-programa">
                        <div class="searchable-select-trigger" id="trigger-programa" onclick="toggleSearchableSelect('programa', event)">
                            <svg class="trigger-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                            </svg>
                            <span class="trigger-text placeholder" id="text-programa">-- Todos los Programas Académicos --</span>
                            <div class="trigger-actions">
                                <button type="button" class="btn-clear-choice" id="btn-clear-programa" style="display:none;" onclick="clearSearchableChoice('programa', event)" title="Limpiar carrera">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                                <svg class="trigger-chevron" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                        </div>
                        <div class="searchable-select-dropdown" id="dropdown-programa">
                            <div class="searchable-search-wrapper">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                <input type="text" class="searchable-search-input" id="search-programa" placeholder="Buscar carrera o maestría (ej: Civil, Derecho, Salud)..." oninput="onFilterSearchable('programa')">
                            </div>
                            <div class="searchable-filter-hint" id="hint-programa" style="display:none;">
                                <span>Filtrando por: <strong id="hint-unidad-name"></strong></span>
                                <button type="button" class="btn-reset-filter" onclick="clearSearchableChoice('unidad', event)">Ver todas</button>
                            </div>
                            <div class="searchable-options-list" id="list-programa">
                                <div class="searchable-option all-option selected" data-value="" onclick="selectSearchableOption('programa', '', '-- Todos los Programas Académicos --')">
                                    <span class="option-check">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span class="option-title">-- Todos los Programas Académicos --</span>
                                </div>
                                @foreach($programas as $prog)
                                    @php
                                        $unidadesDelProg = $mapaProgramas->get($prog, collect())->implode('||');
                                    @endphp
                                    <div class="searchable-option" data-value="{{ $prog }}" data-unidades="{{ $unidadesDelProg }}" onclick="selectSearchableOption('programa', '{{ addslashes($prog) }}', '{{ addslashes($prog) }}')">
                                        <span class="option-check">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        </span>
                                        <div class="option-content">
                                            <span class="option-title">{{ $prog }}</span>
                                            @if($unidadesDelProg)
                                                <span class="option-subtitle">
                                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle; margin-right:2px;">
                                                        <line x1="3" y1="21" x2="21" y2="21"></line>
                                                        <polyline points="3 10 12 4 21 10"></polyline>
                                                    </svg>
                                                    {{ str_replace('||', ', ', $unidadesDelProg) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="searchable-no-results" id="no-results-programa" style="display:none;">
                                No se encontró ningún programa con ese nombre
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Accesos Rápidos de Filtrado -->
            <div class="quick-filters">
                <span class="quick-filters-label">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                    </svg>
                    Atajos:
                </span>
                <button type="button" class="quick-tag active" onclick="aplicarAtajo('', this)">Todos</button>
                <button type="button" class="quick-tag" onclick="aplicarAtajo('ingresantes', this)">Solo Ingresantes</button>
                <button type="button" class="quick-tag" onclick="aplicarAtajo('pregrado', this)">Pregrado</button>
                <button type="button" class="quick-tag" onclick="aplicarAtajo('posgrado', this)">Posgrado</button>
                <button type="button" class="quick-tag" onclick="aplicarAtajo('cepre', this)">CEPRE</button>
                <span class="quick-divider">|</span>
                <span class="quick-filters-label">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    Años:
                </span>
                @if(isset($anios) && count($anios) > 0)
                    @foreach($anios->take(6) as $a)
                        <button type="button" class="quick-tag" onclick="aplicarAtajo('anio_{{ $a }}', this)">{{ $a }}</button>
                    @endforeach
                @else
                    <button type="button" class="quick-tag" onclick="aplicarAtajo('anio_2026', this)">2026</button>
                    <button type="button" class="quick-tag" onclick="aplicarAtajo('anio_2025', this)">2025</button>
                    <button type="button" class="quick-tag" onclick="aplicarAtajo('anio_2024', this)">2024</button>
                    <button type="button" class="quick-tag" onclick="aplicarAtajo('anio_2023', this)">2023</button>
                    <button type="button" class="quick-tag" onclick="aplicarAtajo('anio_2022', this)">2022</button>
                @endif
            </div>
        </div>

        <!-- Estadísticas y Paginación Superior -->
        <div class="stats-bar">
            <div class="stats-left">
                <span>Total encontrados: <span class="stat-highlight" id="stat-total">0</span></span>
                <span>Tiempo: <span id="stat-time" style="color: var(--text-muted);">0 ms</span></span>
            </div>

            <div class="table-controls">
                <label for="per_page" style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600;">Mostrar:</label>
                <select id="per_page" class="form-control" style="width: auto; padding: 0.25rem 1.6rem 0.25rem 0.5rem;" onchange="buscarPostulantes(1)">
                    <option value="10">10</option>
                    <option value="25" selected>25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>

                <!-- Menú desplegable de Exportación -->
                <div class="export-dropdown-wrapper">
                    <button type="button" class="btn-export" id="btn-export" onclick="toggleExportMenu(event)" title="Exportar postulantes filtrados">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                        <span>Exportar</span>
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>

                    <!-- Barra de progreso 0% a 100% y Cancelar -->
                    <div class="export-progress-box" id="export-progress-box" style="display: none;">
                        <div class="export-progress-bar-fill" id="export-progress-fill" style="width: 0%;"></div>
                        <div class="export-progress-info">
                            <div class="export-progress-status">
                                <span class="export-spinner" id="export-spinner">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="spin-icon"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>
                                </span>
                                <span class="export-format-badge" id="export-format-badge">XLSX</span>
                                <span class="export-pct-text" id="export-pct-text">0%</span>
                            </div>
                            <button type="button" class="btn-cancel-export" id="btn-cancel-export" onclick="cancelarExportacion(event)" title="Cancelar exportación">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                                <span>Cancelar</span>
                            </button>
                        </div>
                    </div>

                    <div class="export-menu" id="export-menu">
                        <div class="export-menu-item" onclick="exportar('xlsx')">
                            <span class="export-badge export-badge-excel">XLSX</span>
                            <div>
                                <div class="export-title">Exportar a Excel (.xlsx)</div>
                                <div class="export-desc">Formato oficial con filtros aplicados</div>
                            </div>
                        </div>
                        <div class="export-menu-item" onclick="exportar('csv')">
                            <span class="export-badge export-badge-csv">CSV</span>
                            <div>
                                <div class="export-title">Exportar a CSV (.csv)</div>
                                <div class="export-desc">Texto delimitado en UTF-8 con filtros</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Datos -->
        <div class="results-card">
            <div class="table-responsive">
                <div id="loading-overlay" class="loading-overlay" style="display: none;">
                    <div class="spinner"></div>
                    <span style="font-size: 0.825rem; font-weight: 600; color: var(--text-muted);">Cargando...</span>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID Postulante</th>
                            <th>Sede / Filial</th>
                            <th>DNI</th>
                            <th>Postulante</th>
                            <th>Nivel Académico</th>
                            <th>Programa Académico (Carrera)</th>
                            <th>Facultad / Unidad</th>
                            <th>Proceso</th>
                            <th>Conv.</th>
                            <th>F. Convocatoria</th>
                            <th>Modalidad</th>
                            <th>Ingresante</th>
                            <th>F. Registro</th>
                            <th style="text-align: center;">Ficha</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-postulantes">
                        <!-- Filas insertadas dinámicamente -->
                    </tbody>
                </table>
            </div>

            <!-- Paginación Inferior -->
            <div class="pagination-container">
                <div class="page-info" id="pagination-info">
                    Mostrando 0 de 0 registros
                </div>
                <div class="pagination-buttons" id="pagination-buttons">
                    <!-- Botones de paginación generados dinámicamente -->
                </div>
            </div>
        </div>

    </main>

    <script>
        let currentPage = 1;
        let totalRegistrosActuales = {{ $totalGeneral ?? 0 }};
        let exportAbortController = null;
        let exportProgressInterval = null;

        function formatDni(doc) {
            if (!doc) return '-';
            const num = doc.replace(/^[A-Za-z\s.:-]+/, '').trim();
            return num || doc;
        }

        document.addEventListener('DOMContentLoaded', () => {
            buscarPostulantes(1);
        });

        function limpiarFiltros() {
            document.getElementById('search_global').value = '';
            
            // Limpiar selects personalizados
            ['filial', 'nivel_academico', 'tipo_proceso', 'proceso_anio', 'proceso_num', 'numero_convocatoria', 'fecha_convocatorias', 'modalidad_ingreso'].forEach(id => {
                selectCustomOption(id, '', '', false);
            });
            selectCustomOption('ordenar_por', 'recientes', 'Más recientes primero', false);

            // Limpiar buscador inteligente
            clearSearchableChoice('unidad', null, false);
            clearSearchableChoice('programa', null, false);

            // Limpiar switch de ingresante
            setIngresante('', null, false);

            // Limpiar fechas
            document.getElementById('fecha_inicio').value = '';
            document.getElementById('fecha_fin').value = '';
            const btnFechas = document.getElementById('btn-clear-fechas');
            if (btnFechas) btnFechas.style.display = 'none';

            // Resetear atajos
            document.querySelectorAll('.quick-tag').forEach(t => t.classList.remove('active'));
            document.querySelector('.quick-tag').classList.add('active');

            buscarPostulantes(1);
        }

        function aplicarAtajo(tipo, btn) {
            document.querySelectorAll('.quick-tag').forEach(t => t.classList.remove('active'));
            btn.classList.add('active');

            if (tipo === '') {
                setIngresante('', null, false);
                selectCustomOption('nivel_academico', '', '', false);
                selectCustomOption('proceso_anio', '', '', false);
                selectCustomOption('modalidad_ingreso', '', '', false);
                document.getElementById('fecha_inicio').value = '';
                document.getElementById('fecha_fin').value = '';
                const btnFechas = document.getElementById('btn-clear-fechas');
                if (btnFechas) btnFechas.style.display = 'none';
            } else if (tipo === 'ingresantes') {
                setIngresante('SI', null, false);
            } else if (tipo === 'pregrado') {
                selectCustomOption('nivel_academico', 'Carrera Profesional (Pregrado)', 'Carrera Profesional (Pregrado)', false);
            } else if (tipo === 'posgrado') {
                selectCustomOption('nivel_academico', 'Maestría (Posgrado)', 'Maestría (Posgrado)', false);
            } else if (tipo === 'cepre') {
                selectCustomOption('modalidad_ingreso', 'CEPRE', 'CEPRE', false);
            } else if (tipo.startsWith('anio_')) {
                const year = tipo.replace('anio_', '');
                document.getElementById('fecha_inicio').value = `${year}-01-01`;
                document.getElementById('fecha_fin').value = `${year}-12-31`;
                const btnFechas = document.getElementById('btn-clear-fechas');
                if (btnFechas) btnFechas.style.display = 'inline-block';
            }
            buscarPostulantes(1);
        }

        async function buscarPostulantes(page = 1) {
            currentPage = page;
            const overlay = document.getElementById('loading-overlay');
            overlay.style.display = 'flex';

            const params = new URLSearchParams({
                page: page,
                per_page: document.getElementById('per_page').value,
                search_global: document.getElementById('search_global').value,
                filial: document.getElementById('filial').value,
                nivel_academico: document.getElementById('nivel_academico').value,
                tipo_proceso: document.getElementById('tipo_proceso').value,
                proceso_anio: document.getElementById('proceso_anio').value,
                proceso_num: document.getElementById('proceso_num').value,
                numero_convocatoria: document.getElementById('numero_convocatoria').value,
                fecha_convocatorias: document.getElementById('fecha_convocatorias').value,
                unidad: document.getElementById('unidad').value,
                programa: document.getElementById('programa').value,
                modalidad_ingreso: document.getElementById('modalidad_ingreso').value,
                es_ingresante: document.getElementById('es_ingresante').value,
                fecha_inicio: document.getElementById('fecha_inicio').value,
                fecha_fin: document.getElementById('fecha_fin').value,
                ordenar_por: document.getElementById('ordenar_por').value
            });

            try {
                const response = await fetch(`/api/postulantes/buscar?${params.toString()}`);
                const res = await response.json();

                if (res.success) {
                    totalRegistrosActuales = res.total;
                    renderizarTabla(res.data, res.from);
                    renderizarPaginacion(res);
                    document.getElementById('stat-total').textContent = Number(res.total).toLocaleString();
                    document.getElementById('stat-time').textContent = `${res.execution_time_ms} ms`;
                }
            } catch (error) {
                console.error("Error al consultar:", error);
            } finally {
                overlay.style.display = 'none';
            }
        }

        function renderizarTabla(postulantes, startIndex) {
            const tbody = document.getElementById('tabla-postulantes');
            tbody.innerHTML = '';

            if (postulantes.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="10" style="text-align: center; padding: 2.5rem; color: #64748b;">
                            <p style="font-weight: 600;">No se encontraron registros para los criterios especificados.</p>
                            <p style="font-size: 0.785rem; margin-top: 0.25rem;">Intenta con otros términos o limpia los filtros.</p>
                        </td>
                    </tr>
                `;
                return;
            }

            postulantes.forEach((p, index) => {
                const tr = document.createElement('tr');
                const rowNum = (startIndex || 1) + index;
                const esIng = (p.es_ingresante || '').toUpperCase();
                const badgeClass = (esIng === 'SI' || esIng === 'SÍ') ? 'badge-success' : 'badge-muted';

                tr.innerHTML = `
                    <td style="color: var(--text-muted); font-size: 0.75rem;">${rowNum}</td>
                    <td style="font-family: monospace; font-size: 0.74rem; color: #475569;">${p.id_postulante || '-'}</td>
                    <td style="font-size: 0.75rem; color: #475569; font-weight: 600;">${p.filial || '-'}</td>
                    <td><span class="doc-dni">${formatDni(p.documento_identidad)}</span></td>
                    <td style="font-weight: 600; color: #0f172a;">${p.postulante || '-'}</td>
                    <td style="font-size: 0.75rem; color: #475569;">${p.nivel_academico || '-'}</td>
                    <td style="color: var(--primary); font-weight: 600;">${p.programa || '-'}</td>
                    <td style="font-size: 0.77rem; color: #475569;">${p.unidad || '-'}</td>
                    <td><span class="badge badge-process">${p.proceso_admision || '-'}</span></td>
                    <td style="text-align: center;">${p.numero_convocatoria || '-'}</td>
                    <td style="font-size: 0.75rem; color: #64748b;">${p.fecha_convocatorias || '-'}</td>
                    <td style="font-size: 0.78rem;">${p.modalidad_ingreso || '-'}</td>
                    <td><span class="badge ${badgeClass}">${p.es_ingresante || 'NO'}</span></td>
                    <td style="font-size: 0.75rem; color: var(--text-muted);">${p.fecha_registro || '-'}</td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-secondary" style="padding: 4px 7px; font-size: 0.75rem; display: inline-flex; align-items: center; justify-content: center;" onclick='abrirModalDetalle(${JSON.stringify(p).replace(/'/g, "&#39;")})' title="Ver Ficha Completa">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        function renderizarPaginacion(res) {
            const info = document.getElementById('pagination-info');
            const btns = document.getElementById('pagination-buttons');
            
            info.textContent = `Mostrando ${Number(res.from).toLocaleString()} a ${Number(res.to).toLocaleString()} de ${Number(res.total).toLocaleString()} registros`;
            btns.innerHTML = '';

            if (res.last_page <= 1) return;

            const btnPrev = document.createElement('button');
            btnPrev.className = 'page-btn';
            btnPrev.innerHTML = '&laquo;';
            btnPrev.disabled = res.current_page === 1;
            btnPrev.onclick = () => buscarPostulantes(res.current_page - 1);
            btns.appendChild(btnPrev);

            let startPage = Math.max(1, res.current_page - 2);
            let endPage = Math.min(res.last_page, res.current_page + 2);

            if (startPage > 1) {
                const btnFirst = document.createElement('button');
                btnFirst.className = 'page-btn';
                btnFirst.textContent = '1';
                btnFirst.onclick = () => buscarPostulantes(1);
                btns.appendChild(btnFirst);

                if (startPage > 2) {
                    const spanDots = document.createElement('span');
                    spanDots.textContent = '...';
                    spanDots.style.padding = '0 2px';
                    spanDots.style.color = '#94a3b8';
                    btns.appendChild(spanDots);
                }
            }

            for (let i = startPage; i <= endPage; i++) {
                const btnPage = document.createElement('button');
                btnPage.className = `page-btn ${i === res.current_page ? 'active' : ''}`;
                btnPage.textContent = i;
                btnPage.onclick = () => buscarPostulantes(i);
                btns.appendChild(btnPage);
            }

            if (endPage < res.last_page) {
                if (endPage < res.last_page - 1) {
                    const spanDots = document.createElement('span');
                    spanDots.textContent = '...';
                    spanDots.style.padding = '0 2px';
                    spanDots.style.color = '#94a3b8';
                    btns.appendChild(spanDots);
                }

                const btnLast = document.createElement('button');
                btnLast.className = 'page-btn';
                btnLast.textContent = res.last_page;
                btnLast.onclick = () => buscarPostulantes(res.last_page);
                btns.appendChild(btnLast);
            }

            const btnNext = document.createElement('button');
            btnNext.className = 'page-btn';
            btnNext.innerHTML = '&raquo;';
            btnNext.disabled = res.current_page === res.last_page;
            btnNext.onclick = () => buscarPostulantes(res.current_page + 1);
            btns.appendChild(btnNext);
        }

        // Modal de Ficha Detallada
        function abrirModalDetalle(p) {
            const body = document.getElementById('modal-detalle-body');
            const esIng = (p.es_ingresante || '').toUpperCase();
            const colorIng = (esIng === 'SI' || esIng === 'SÍ') ? '#059669' : '#dc2626';

            body.innerHTML = `
                <div class="detail-item"><span class="detail-label">ID Postulante</span><span class="detail-val">${p.id_postulante || '-'}</span></div>
                <div class="detail-item"><span class="detail-label">GUID</span><span class="detail-val" style="font-size:0.75rem; font-family:monospace;">${p.guid || '-'}</span></div>
                <div class="detail-item"><span class="detail-label">DNI</span><span class="detail-val"><span class="doc-dni">${formatDni(p.documento_identidad)}</span></span></div>
                <div class="detail-item"><span class="detail-label">Postulante</span><span class="detail-val" style="color:var(--primary); font-size:0.95rem;">${p.postulante || '-'}</span></div>
                <div class="detail-item"><span class="detail-label">ID Persona</span><span class="detail-val">${p.id_persona || '-'}</span></div>
                <div class="detail-item"><span class="detail-label">Entidad</span><span class="detail-val">${p.entidad || '-'} (ID: ${p.id_entidad || '-'})</span></div>
                <div class="detail-item"><span class="detail-label">Sede / Filial</span><span class="detail-val">${p.filial || '-'} (ID: ${p.id_filial || '-'})</span></div>
                <div class="detail-item"><span class="detail-label">Nivel Académico</span><span class="detail-val">${p.nivel_academico || '-'} (ID: ${p.id_nivel_academico || '-'})</span></div>
                <div class="detail-item"><span class="detail-label">Tipo de Proceso</span><span class="detail-val">${p.tipo_proceso || '-'}</span></div>
                <div class="detail-item"><span class="detail-label">Proceso Admisión</span><span class="detail-val"><span class="badge badge-process">${p.proceso_admision || '-'}</span></span></div>
                <div class="detail-item"><span class="detail-label">N° Convocatoria</span><span class="detail-val">${p.numero_convocatoria || '-'}</span></div>
                <div class="detail-item"><span class="detail-label">Fecha Convocatorias</span><span class="detail-val">${p.fecha_convocatorias || '-'}</span></div>
                <div class="detail-item" style="grid-column: span 2;"><span class="detail-label">Facultad / Unidad</span><span class="detail-val">${p.unidad || '-'}</span></div>
                <div class="detail-item" style="grid-column: span 2;"><span class="detail-label">Programa / Carrera</span><span class="detail-val" style="color:var(--primary);">${p.programa || '-'}</span></div>
                <div class="detail-item"><span class="detail-label">Modalidad de Ingreso</span><span class="detail-val">${p.modalidad_ingreso || '-'}</span></div>
                <div class="detail-item"><span class="detail-label">¿Es Ingresante?</span><span class="detail-val" style="font-weight:800; color: ${colorIng}">${p.es_ingresante || 'NO'}</span></div>
                <div class="detail-item"><span class="detail-label">Fecha de Registro</span><span class="detail-val">${p.fecha_registro || '-'}</span></div>
                <div class="detail-item"><span class="detail-label">Fila Origen en CSV</span><span class="detail-val">#${p.row_num || '-'}</span></div>
            `;
            document.getElementById('modal-detalle').style.display = 'flex';
        }

        function cerrarModalDetalle() {
            document.getElementById('modal-detalle').style.display = 'none';
        }

        function toggleExportMenu(event) {
            event.stopPropagation();
            const menu = document.getElementById('export-menu');
            menu.classList.toggle('show');
        }

        function cancelarExportacion(event) {
            if (event) event.stopPropagation();
            if (exportAbortController) {
                exportAbortController.abort();
            }
        }

        function actualizarUIExportacionProgreso(pct, formato, estadoTexto) {
            const fill = document.getElementById('export-progress-fill');
            const pctText = document.getElementById('export-pct-text');
            const badge = document.getElementById('export-format-badge');

            if (!fill || !pctText) return;

            if (badge) {
                badge.textContent = formato.toUpperCase();
                badge.className = `export-format-badge ${formato.toLowerCase()}`;
            }

            fill.style.width = `${pct}%`;
            pctText.textContent = estadoTexto || `${pct}%`;
        }

        function iniciarUIExportacion(formato) {
            const btn = document.getElementById('btn-export');
            const box = document.getElementById('export-progress-box');
            const fill = document.getElementById('export-progress-fill');
            const spinner = document.getElementById('export-spinner');
            const cancelBtn = document.getElementById('btn-cancel-export');

            if (btn) btn.style.display = 'none';
            if (box) box.style.display = 'inline-flex';
            if (fill) {
                fill.style.width = '0%';
                fill.className = 'export-progress-bar-fill';
            }
            if (spinner) {
                spinner.className = 'export-spinner';
                spinner.innerHTML = `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="spin-icon"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>`;
            }
            if (cancelBtn) cancelBtn.style.display = 'inline-flex';

            actualizarUIExportacionProgreso(0, formato, '0%');
        }

        function restaurarUIExportacion(delayMs = 0) {
            setTimeout(() => {
                const btn = document.getElementById('btn-export');
                const box = document.getElementById('export-progress-box');
                if (box) box.style.display = 'none';
                if (btn) btn.style.display = 'inline-flex';
            }, delayMs);
        }

        function finalizarUIExportacion(exito, formato, mensaje = '') {
            if (exportProgressInterval) {
                clearInterval(exportProgressInterval);
                exportProgressInterval = null;
            }

            const fill = document.getElementById('export-progress-fill');
            const spinner = document.getElementById('export-spinner');
            const pctText = document.getElementById('export-pct-text');
            const cancelBtn = document.getElementById('btn-cancel-export');

            if (cancelBtn) cancelBtn.style.display = 'none';

            if (exito) {
                if (fill) {
                    fill.style.width = '100%';
                    fill.className = 'export-progress-bar-fill success';
                }
                if (spinner) {
                    spinner.className = 'export-spinner success';
                    spinner.innerHTML = `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>`;
                }
                if (pctText) pctText.textContent = '¡Listo! 100%';
                restaurarUIExportacion(1400);
            } else {
                if (fill) fill.className = 'export-progress-bar-fill cancelled';
                if (spinner) {
                    spinner.innerHTML = `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>`;
                }
                if (pctText) pctText.textContent = mensaje || 'Cancelado';
                restaurarUIExportacion(1000);
            }
        }

        async function exportar(formato) {
            const menu = document.getElementById('export-menu');
            if (menu) menu.classList.remove('show');

            if (exportAbortController) {
                return;
            }

            const params = new URLSearchParams({
                formato: formato,
                search_global: document.getElementById('search_global').value,
                filial: document.getElementById('filial').value,
                nivel_academico: document.getElementById('nivel_academico').value,
                tipo_proceso: document.getElementById('tipo_proceso').value,
                proceso_anio: document.getElementById('proceso_anio').value,
                proceso_num: document.getElementById('proceso_num').value,
                numero_convocatoria: document.getElementById('numero_convocatoria').value,
                fecha_convocatorias: document.getElementById('fecha_convocatorias').value,
                unidad: document.getElementById('unidad').value,
                programa: document.getElementById('programa').value,
                modalidad_ingreso: document.getElementById('modalidad_ingreso').value,
                es_ingresante: document.getElementById('es_ingresante').value,
                fecha_inicio: document.getElementById('fecha_inicio').value,
                fecha_fin: document.getElementById('fecha_fin').value,
                ordenar_por: document.getElementById('ordenar_por').value
            });

            exportAbortController = new AbortController();
            const signal = exportAbortController.signal;

            iniciarUIExportacion(formato);

            let currentPct = 0;
            exportProgressInterval = setInterval(() => {
                if (currentPct < 12) {
                    currentPct += 2;
                    actualizarUIExportacionProgreso(currentPct, formato);
                }
            }, 180);

            try {
                const response = await fetch(`/postulantes/exportar?${params.toString()}`, {
                    method: 'GET',
                    signal: signal
                });

                if (!response.ok) {
                    throw new Error(`Error HTTP: ${response.status}`);
                }

                if (exportProgressInterval) {
                    clearInterval(exportProgressInterval);
                    exportProgressInterval = null;
                }

                let filename = `postulantes_${new Date().toISOString().slice(0, 10)}.${formato}`;
                const disposition = response.headers.get('content-disposition');
                if (disposition && disposition.indexOf('filename=') !== -1) {
                    const matches = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/.exec(disposition);
                    if (matches != null && matches[1]) {
                        filename = matches[1].replace(/['"]/g, '').trim();
                    }
                }

                const totalHeader = response.headers.get('X-Total-Count');
                const totalRegistros = totalHeader ? parseInt(totalHeader, 10) : (totalRegistrosActuales || 1000);

                const contentLength = response.headers.get('content-length');
                const expectedBytes = contentLength 
                    ? parseInt(contentLength, 10) 
                    : Math.max(1024, totalRegistros * (formato === 'csv' ? 158 : 65));

                const reader = response.body.getReader();
                const chunks = [];
                let receivedBytes = 0;

                while (true) {
                    const { done, value } = await reader.read();
                    if (done) break;

                    chunks.push(value);
                    receivedBytes += value.length;

                    const calcPct = Math.min(99, Math.max(1, Math.round((receivedBytes / expectedBytes) * 100)));
                    if (calcPct > currentPct) {
                        currentPct = calcPct;
                        actualizarUIExportacionProgreso(currentPct, formato);
                    }
                }

                currentPct = 100;
                actualizarUIExportacionProgreso(100, formato);

                const mimeType = formato === 'csv'
                    ? 'text/csv;charset=utf-8;'
                    : 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
                const blob = new Blob(chunks, { type: mimeType });
                const downloadUrl = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = downloadUrl;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                a.remove();
                setTimeout(() => window.URL.revokeObjectURL(downloadUrl), 2000);

                finalizarUIExportacion(true, formato);
            } catch (err) {
                if (err.name === 'AbortError') {
                    finalizarUIExportacion(false, formato, 'Cancelado');
                } else {
                    console.error('Error al exportar:', err);
                    finalizarUIExportacion(false, formato, 'Error');
                }
            } finally {
                exportAbortController = null;
                if (exportProgressInterval) {
                    clearInterval(exportProgressInterval);
                    exportProgressInterval = null;
                }
            }
        }

        // Función Switch para Es Ingresante
        function setIngresante(val, btn, triggerSearch = true) {
            document.querySelectorAll('#switch-ingresante .switch-opt').forEach(b => b.classList.remove('active'));
            if (btn) {
                btn.classList.add('active');
            } else {
                const target = document.querySelector(`#switch-ingresante .switch-opt[data-val="${val}"]`);
                if (target) target.classList.add('active');
            }
            document.getElementById('es_ingresante').value = val;
            if (triggerSearch) {
                buscarPostulantes(1);
            }
        }

        // Funciones para Rango de Fechas
        function onDateRangeChange() {
            const ini = document.getElementById('fecha_inicio').value;
            const fin = document.getElementById('fecha_fin').value;
            const btn = document.getElementById('btn-clear-fechas');
            if (btn) btn.style.display = (ini || fin) ? 'inline-block' : 'none';
            buscarPostulantes(1);
        }

        function limpiarFechasRegistro() {
            document.getElementById('fecha_inicio').value = '';
            document.getElementById('fecha_fin').value = '';
            const btn = document.getElementById('btn-clear-fechas');
            if (btn) btn.style.display = 'none';
            document.querySelectorAll('.quick-tag').forEach(t => {
                if (t.textContent.trim().match(/^\d{4}$/)) {
                    t.classList.remove('active');
                }
            });
            buscarPostulantes(1);
        }

        // Funciones para Selects Personalizados (Dropdowns con efecto Hover)
        function toggleCustomSelect(tipo, event) {
            if (event) event.stopPropagation();
            const currentDropdown = document.getElementById(`dropdown-${tipo}`);
            const currentTrigger = document.getElementById(`trigger-${tipo}`);
            const isOpen = currentDropdown.classList.contains('show');

            // Cerrar cualquier otro menú o selector abierto
            document.querySelectorAll('.custom-select-dropdown, .searchable-select-dropdown').forEach(d => d.classList.remove('show'));
            document.querySelectorAll('.custom-select-trigger, .searchable-select-trigger').forEach(t => t.classList.remove('active'));
            const exportMenu = document.getElementById('export-menu');
            if (exportMenu) exportMenu.classList.remove('show');

            if (!isOpen) {
                currentDropdown.classList.add('show');
                currentTrigger.classList.add('active');
            }
        }

        function selectCustomOption(tipo, value, displayText, triggerSearch = true) {
            const hiddenInput = document.getElementById(tipo);
            if (hiddenInput) hiddenInput.value = value;

            const textSpan = document.getElementById(`text-${tipo}`);
            const clearBtn = document.getElementById(`btn-clear-${tipo}`);
            const defaultPlaceholder = textSpan ? (textSpan.dataset.default || '--seleccione--') : '--seleccione--';

            if (textSpan) {
                if (value) {
                    textSpan.textContent = displayText;
                    textSpan.classList.remove('placeholder');
                    if (clearBtn) clearBtn.style.display = 'inline-block';
                } else {
                    textSpan.textContent = defaultPlaceholder;
                    if (tipo !== 'ordenar_por') {
                        textSpan.classList.add('placeholder');
                    }
                    if (clearBtn) clearBtn.style.display = 'none';
                }
            }

            // Marcar visualmente la opción seleccionada
            document.querySelectorAll(`#list-${tipo} .custom-select-option`).forEach(opt => {
                const isSel = (opt.dataset.value || '') === value;
                opt.classList.toggle('selected', isSel);
            });

            // Cerrar el dropdown
            const dropdown = document.getElementById(`dropdown-${tipo}`);
            const trigger = document.getElementById(`trigger-${tipo}`);
            if (dropdown) dropdown.classList.remove('show');
            if (trigger) trigger.classList.remove('active');

            if (triggerSearch) {
                buscarPostulantes(1);
            }
        }

        function clearCustomChoice(tipo, event) {
            if (event) event.stopPropagation();
            selectCustomOption(tipo, '', '');
        }

        // Funciones para Selects con Buscador Inteligente (Combobox)
        let activeUnitFilter = '';
        const normalizeText = (str) => (str || '').normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase().trim();

        function toggleSearchableSelect(tipo, event) {
            if (event) event.stopPropagation();
            const currentDropdown = document.getElementById(`dropdown-${tipo}`);
            const currentTrigger = document.getElementById(`trigger-${tipo}`);
            const isOpen = currentDropdown.classList.contains('show');

            // Cerrar cualquier otro menú o selector abierto
            document.querySelectorAll('.custom-select-dropdown, .searchable-select-dropdown').forEach(d => d.classList.remove('show'));
            document.querySelectorAll('.custom-select-trigger, .searchable-select-trigger').forEach(t => t.classList.remove('active'));
            const exportMenu = document.getElementById('export-menu');
            if (exportMenu) exportMenu.classList.remove('show');

            if (!isOpen) {
                currentDropdown.classList.add('show');
                currentTrigger.classList.add('active');
                const searchInput = document.getElementById(`search-${tipo}`);
                if (searchInput) {
                    searchInput.value = '';
                    onFilterSearchable(tipo);
                    setTimeout(() => searchInput.focus(), 60);
                }
            }
        }

        function onFilterSearchable(tipo) {
            const term = normalizeText(document.getElementById(`search-${tipo}`).value);
            const options = document.querySelectorAll(`#list-${tipo} .searchable-option:not(.all-option)`);
            let visibleCount = 0;

            options.forEach(opt => {
                const titleEl = opt.querySelector('.option-title');
                const optText = normalizeText(titleEl ? titleEl.textContent : opt.textContent);
                const matchesSearch = !term || optText.includes(term);

                let matchesUnit = true;
                if (tipo === 'programa' && activeUnitFilter) {
                    const unidades = (opt.dataset.unidades || '').split('||');
                    matchesUnit = unidades.includes(activeUnitFilter);
                }

                if (matchesSearch && matchesUnit) {
                    opt.style.display = 'flex';
                    visibleCount++;
                } else {
                    opt.style.display = 'none';
                }
            });

            const noResults = document.getElementById(`no-results-${tipo}`);
            if (noResults) {
                noResults.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        }

        function selectSearchableOption(tipo, value, displayText) {
            const hiddenInput = document.getElementById(tipo);
            hiddenInput.value = value;

            const textSpan = document.getElementById(`text-${tipo}`);
            const clearBtn = document.getElementById(`btn-clear-${tipo}`);

            if (value) {
                textSpan.textContent = displayText;
                textSpan.classList.remove('placeholder');
                if (clearBtn) clearBtn.style.display = 'inline-block';
            } else {
                textSpan.textContent = (tipo === 'unidad') ? '-- Todas las Facultades / Unidades --' : '-- Todos los Programas Académicos --';
                textSpan.classList.add('placeholder');
                if (clearBtn) clearBtn.style.display = 'none';
            }

            // Marcar visualmente la opción seleccionada
            document.querySelectorAll(`#list-${tipo} .searchable-option`).forEach(opt => {
                const isSel = (opt.dataset.value || '') === value;
                opt.classList.toggle('selected', isSel);
            });

            // Cerrar el dropdown
            const dropdown = document.getElementById(`dropdown-${tipo}`);
            const trigger = document.getElementById(`trigger-${tipo}`);
            if (dropdown) dropdown.classList.remove('show');
            if (trigger) trigger.classList.remove('active');

            // Si cambió la unidad, sincronizar las carreras/programas
            if (tipo === 'unidad') {
                activeUnitFilter = value;
                actualizarFiltroProgramasPorUnidad(value);
            } else if (tipo === 'programa' && value) {
                // Si seleccionó programa pero la unidad está vacía, auto-asignar su facultad
                const selectedOpt = document.querySelector(`#list-programa .searchable-option[data-value="${CSS.escape(value)}"]`);
                if (selectedOpt && selectedOpt.dataset.unidades && !document.getElementById('unidad').value) {
                    const primaryUnit = selectedOpt.dataset.unidades.split('||')[0];
                    if (primaryUnit) {
                        selectSearchableOption('unidad', primaryUnit, primaryUnit);
                        return;
                    }
                }
            }

            buscarPostulantes(1);
        }

        function clearSearchableChoice(tipo, event, triggerSearch = true) {
            if (event) event.stopPropagation();
            selectSearchableOption(tipo, '', '');
            if (tipo === 'unidad') {
                activeUnitFilter = '';
                actualizarFiltroProgramasPorUnidad('');
            }
            if (triggerSearch) {
                buscarPostulantes(1);
            }
        }

        function actualizarFiltroProgramasPorUnidad(unidadSeleccionada) {
            const hintEl = document.getElementById('hint-programa');
            const hintName = document.getElementById('hint-unidad-name');
            const badgeCountProg = document.getElementById('badge-count-programa');
            const currentSelectedProg = document.getElementById('programa').value;

            let count = 0;
            let selectedStillValid = false;

            document.querySelectorAll('#list-programa .searchable-option:not(.all-option)').forEach(opt => {
                const unidades = (opt.dataset.unidades || '').split('||');
                const matches = !unidadSeleccionada || unidades.includes(unidadSeleccionada);
                if (matches) {
                    opt.style.display = 'flex';
                    count++;
                    if (opt.dataset.value === currentSelectedProg) {
                        selectedStillValid = true;
                    }
                } else {
                    opt.style.display = 'none';
                }
            });

            if (unidadSeleccionada) {
                if (hintEl) hintEl.style.display = 'flex';
                if (hintName) hintName.textContent = unidadSeleccionada;
                if (badgeCountProg) badgeCountProg.textContent = `${count} programas`;
                if (currentSelectedProg && !selectedStillValid) {
                    clearSearchableChoice('programa', null, false);
                }
            } else {
                if (hintEl) hintEl.style.display = 'none';
                if (badgeCountProg) badgeCountProg.textContent = `${count} programas`;
            }
        }

        // Cerrar modal o menús desplegables al hacer clic fuera
        window.onclick = function(event) {
            const modal = document.getElementById('modal-detalle');
            if (event.target === modal) {
                cerrarModalDetalle();
            }
            if (!event.target.closest('.export-dropdown-wrapper')) {
                const exportMenu = document.getElementById('export-menu');
                if (exportMenu) exportMenu.classList.remove('show');
            }
            if (!event.target.closest('.searchable-select') && !event.target.closest('.custom-select')) {
                document.querySelectorAll('.searchable-select-dropdown, .custom-select-dropdown').forEach(d => d.classList.remove('show'));
                document.querySelectorAll('.searchable-select-trigger, .custom-select-trigger').forEach(t => t.classList.remove('active'));
            }
        };

        // Funciones de Gestión de Usuarios (Exclusivo Administradores)
        function abrirModalUsuarios() {
            const modal = document.getElementById('modal-usuarios');
            if (modal) {
                modal.style.display = 'flex';
                cambiarTabUsuario('lista');
                cargarListaUsuarios();
            }
        }

        function cerrarModalUsuarios() {
            const modal = document.getElementById('modal-usuarios');
            if (modal) modal.style.display = 'none';
            cancelarCambioClave();
        }

        function cambiarTabUsuario(tab) {
            const btnLista = document.getElementById('tab-btn-users');
            const btnNuevo = document.getElementById('tab-btn-new');
            const contLista = document.getElementById('tab-content-lista');
            const contNuevo = document.getElementById('tab-content-nuevo');

            if (!btnLista || !btnNuevo || !contLista || !contNuevo) return;

            if (tab === 'lista') {
                btnLista.classList.add('active');
                btnNuevo.classList.remove('active');
                contLista.style.display = 'block';
                contNuevo.style.display = 'none';
            } else {
                btnNuevo.classList.add('active');
                btnLista.classList.remove('active');
                contNuevo.style.display = 'block';
                contLista.style.display = 'none';
                cancelarCambioClave();
            }
        }

        async function cargarListaUsuarios() {
            const loading = document.getElementById('loading-usuarios');
            const table = document.getElementById('tabla-usuarios-wrapper');
            const tbody = document.getElementById('tabla-usuarios-body');

            if (!loading || !table || !tbody) return;

            loading.style.display = 'block';
            table.style.display = 'none';

            try {
                const res = await fetch('/api/usuarios');
                const data = await res.json();

                if (data.success) {
                    tbody.innerHTML = '';
                    const currentId = data.current_user_id;

                    data.data.forEach(u => {
                        const tr = document.createElement('tr');
                        const isSelf = (u.id === currentId);
                        const roleClass = (u.role === 'admin') ? 'role-admin' : 'role-operador';
                        const roleLabel = (u.role === 'admin') ? 'Administrador' : 'Operador';
                        const statusClass = u.is_active ? 'status-active' : 'status-inactive';
                        const statusLabel = u.is_active ? 'Activo' : 'Inactivo';

                        tr.innerHTML = `
                            <td>
                                <div style="font-weight: 700; font-size: 0.86rem; color: #0f172a;">
                                    ${u.name} ${isSelf ? '<span style="font-size:0.68rem; background:#dbeafe; color:#1d4ed8; padding:1px 6px; border-radius:3px; font-weight:700; margin-left:4px;">Tu Cuenta</span>' : ''}
                                </div>
                                <div style="font-size: 0.74rem; color: #64748b; margin-top: 2px;">${u.email}</div>
                            </td>
                            <td>
                                <span class="user-role-badge ${roleClass}">${roleLabel}</span>
                            </td>
                            <td>
                                <span class="user-status-pill ${statusClass}">
                                    <span style="display:inline-block; width:6px; height:6px; border-radius:50%; background:${u.is_active ? '#10b981' : '#ef4444'};"></span>
                                    <span>${statusLabel}</span>
                                </span>
                            </td>
                            <td style="text-align: right;">
                                <div class="user-actions" style="justify-content: flex-end;">
                                    <button type="button" class="btn-user-action" onclick="iniciarCambioClave(${u.id}, '${u.name.replace(/'/g, "\\'")}')" title="Modificar contraseña">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                        <span>Clave</span>
                                    </button>
                                    ${!isSelf ? `
                                        <button type="button" class="btn-user-action" onclick="toggleEstadoUsuario(${u.id})" title="${u.is_active ? 'Desactivar acceso temporalmente' : 'Activar acceso'}">
                                            <span>${u.is_active ? 'Desactivar' : 'Activar'}</span>
                                        </button>
                                        <button type="button" class="btn-user-action danger" onclick="eliminarUsuario(${u.id}, '${u.name.replace(/'/g, "\\'")}')" title="Eliminar usuario permanentemente">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        </button>
                                    ` : ''}
                                </div>
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });

                    loading.style.display = 'none';
                    table.style.display = 'table';
                }
            } catch (err) {
                loading.textContent = 'Error al cargar los usuarios.';
                console.error(err);
            }
        }

        async function guardarNuevoUsuario(e) {
            e.preventDefault();
            const btn = document.getElementById('btn-guardar-usuario');
            const alertBox = document.getElementById('alerta-form-usuario');

            const payload = {
                name: document.getElementById('new_name').value,
                email: document.getElementById('new_email').value,
                role: document.getElementById('new_role').value,
                password: document.getElementById('new_password').value
            };

            btn.disabled = true;
            btn.textContent = 'Guardando...';
            alertBox.style.display = 'none';

            try {
                const res = await fetch('/api/usuarios', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(payload)
                });
                const data = await res.json();

                if (res.ok && data.success) {
                    document.getElementById('form-nuevo-usuario').reset();
                    cambiarTabUsuario('lista');
                    cargarListaUsuarios();
                } else {
                    alertBox.style.display = 'block';
                    alertBox.style.backgroundColor = '#fef2f2';
                    alertBox.style.color = '#dc2626';
                    alertBox.style.border = '1px solid #fecaca';
                    alertBox.textContent = data.message || 'Error al registrar el usuario.';
                }
            } catch (err) {
                alertBox.style.display = 'block';
                alertBox.style.backgroundColor = '#fef2f2';
                alertBox.style.color = '#dc2626';
                alertBox.style.border = '1px solid #fecaca';
                alertBox.textContent = 'Ocurrió un error en el servidor.';
                console.error(err);
            } finally {
                btn.disabled = false;
                btn.textContent = 'Registrar Usuario';
            }
        }

        async function toggleEstadoUsuario(id) {
            try {
                const res = await fetch(`/api/usuarios/${id}/toggle-status`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                const data = await res.json();
                if (data.success) {
                    cargarListaUsuarios();
                } else {
                    alert(data.message || 'Error al cambiar estado.');
                }
            } catch (err) {
                console.error(err);
            }
        }

        function iniciarCambioClave(id, name) {
            document.getElementById('panel-cambio-clave').style.display = 'block';
            document.getElementById('pwd-user-id').value = id;
            document.getElementById('pwd-user-name').textContent = name;
            const input = document.getElementById('input-nueva-clave');
            input.value = '';
            input.focus();
        }

        function cancelarCambioClave() {
            const panel = document.getElementById('panel-cambio-clave');
            if (panel) panel.style.display = 'none';
        }

        async function ejecutarCambioClave() {
            const id = document.getElementById('pwd-user-id').value;
            const pwd = document.getElementById('input-nueva-clave').value;

            if (!pwd || pwd.length < 6) {
                alert('La contraseña debe tener al menos 6 caracteres.');
                return;
            }

            try {
                const res = await fetch(`/api/usuarios/${id}/password`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ password: pwd })
                });
                const data = await res.json();

                if (res.ok && data.success) {
                    alert('Contraseña actualizada correctamente.');
                    cancelarCambioClave();
                } else {
                    alert(data.message || 'Error al actualizar contraseña.');
                }
            } catch (err) {
                console.error(err);
            }
        }

        async function eliminarUsuario(id, name) {
            if (!confirm(`¿Estás seguro de que deseas eliminar permanentemente al usuario ${name}?`)) {
                return;
            }

            try {
                const res = await fetch(`/api/usuarios/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                const data = await res.json();

                if (res.ok && data.success) {
                    cargarListaUsuarios();
                } else {
                    alert(data.message || 'Error al eliminar usuario.');
                }
            } catch (err) {
                console.error(err);
            }
        }

        // Atajo teclado Escape para cerrar modales y dropdowns
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                document.querySelectorAll('.searchable-select-dropdown, .custom-select-dropdown').forEach(d => d.classList.remove('show'));
                document.querySelectorAll('.searchable-select-trigger, .custom-select-trigger').forEach(t => t.classList.remove('active'));
                const exportMenu = document.getElementById('export-menu');
                if (exportMenu) exportMenu.classList.remove('show');
                cerrarModalDetalle();
                cerrarModalUsuarios();
            }
        });
    </script>

    <!-- Modal para Ficha Completa del Postulante -->
    <div id="modal-detalle" class="modal-backdrop" style="display: none;">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Ficha Completa de Información del Postulante</h3>
                <button type="button" class="btn-close-modal" onclick="cerrarModalDetalle()" title="Cerrar Ficha" aria-label="Cerrar">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body" id="modal-detalle-body">
                <!-- Información inyectada dinámicamente -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="cerrarModalDetalle()">Cerrar Ficha</button>
            </div>
        </div>
    </div>

    <!-- Modal de Gestión de Usuarios (Exclusivo Administradores) -->
    @if(Auth::check() && Auth::user()->isAdmin())
    <div id="modal-usuarios" class="modal-backdrop" style="display: none;">
        <div class="modal-card modal-lg">
            <div class="modal-header">
                <div style="display: flex; align-items: center; gap: 0.65rem;">
                    <div style="width: 34px; height: 34px; border-radius: 6px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 style="font-size: 1.05rem; font-weight: 700; color: #0f172a; margin: 0;">Gestión de Usuarios del Sistema</h3>
                        <p style="font-size: 0.76rem; color: #64748b; margin: 0;">Administre credenciales, roles y accesos al módulo de postulantes</p>
                    </div>
                </div>
                <button type="button" class="btn-close-modal" onclick="cerrarModalUsuarios()" title="Cerrar Ventana">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <!-- Pestañas del Modal -->
            <div class="modal-tabs">
                <button type="button" class="modal-tab-btn active" id="tab-btn-users" onclick="cambiarTabUsuario('lista')">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    <span>Cuentas Registradas</span>
                </button>
                <button type="button" class="modal-tab-btn" id="tab-btn-new" onclick="cambiarTabUsuario('nuevo')">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    <span>Nuevo Usuario</span>
                </button>
            </div>

            <!-- Panel 1: Lista de Usuarios -->
            <div class="modal-body" id="tab-content-lista" style="padding: 0; max-height: 520px; overflow-y: auto;">
                <div id="loading-usuarios" style="text-align: center; padding: 3rem 1.5rem; color: #64748b;">
                    <div class="spinner" style="margin: 0 auto 0.75rem;"></div>
                    <span>Cargando usuarios del sistema...</span>
                </div>
                <table class="user-mgmt-table" id="tabla-usuarios-wrapper" style="display: none;">
                    <thead>
                        <tr>
                            <th style="width: 40%;">Usuario / Correo Institucional</th>
                            <th style="width: 18%;">Rol de Sistema</th>
                            <th style="width: 16%;">Estado</th>
                            <th style="width: 26%; text-align: right;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-usuarios-body">
                        <!-- Filas insertadas dinámicamente -->
                    </tbody>
                </table>
            </div>

            <!-- Panel 2: Formulario de Nuevo Usuario -->
            <div class="modal-body" id="tab-content-nuevo" style="display: none; padding: 0;">
                <form id="form-nuevo-usuario" onsubmit="guardarNuevoUsuario(event)">
                    <div id="alerta-form-usuario" style="display: none; margin: 1.25rem 1.75rem 0; padding: 0.75rem 1rem; border-radius: 6px; font-size: 0.82rem;"></div>
                    <div class="user-form-grid">
                        <div class="form-group" style="grid-column: span 2;">
                            <label class="form-label" for="new_name" style="font-size: 0.8rem; font-weight: 700; color: #1e293b; margin-bottom: 0.35rem;">Nombre Completo y Apellidos</label>
                            <input type="text" id="new_name" class="form-control" placeholder="Ej. Juan Pérez Quispe" style="height: 38px; font-size: 0.85rem;" required>
                            <span style="font-size: 0.72rem; color: #64748b; margin-top: 4px; display: block;">Nombre oficial del operador o administrador institucional.</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="new_email" style="font-size: 0.8rem; font-weight: 700; color: #1e293b; margin-bottom: 0.35rem;">Correo Institucional (@unap.edu.pe)</label>
                            <input type="email" id="new_email" class="form-control" placeholder="usuario@unap.edu.pe" style="height: 38px; font-size: 0.85rem;" required>
                            <span style="font-size: 0.72rem; color: #64748b; margin-top: 4px; display: block;">Será el identificador único para iniciar sesión.</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="new_role" style="font-size: 0.8rem; font-weight: 700; color: #1e293b; margin-bottom: 0.35rem;">Rol y Nivel de Privilegios</label>
                            <select id="new_role" class="form-control" style="height: 38px; font-size: 0.85rem; cursor: pointer;" required>
                                <option value="operador">Operador (Búsqueda, Filtros y Exportación Excel/CSV)</option>
                                <option value="admin">Administrador (Control Total y Gestión de Usuarios)</option>
                            </select>
                            <span style="font-size: 0.72rem; color: #64748b; margin-top: 4px; display: block;">Define el acceso a configuración y administración de cuentas.</span>
                        </div>
                        <div class="form-group" style="grid-column: span 2;">
                            <label class="form-label" for="new_password" style="font-size: 0.8rem; font-weight: 700; color: #1e293b; margin-bottom: 0.35rem;">Contraseña de Acceso (mínimo 6 caracteres)</label>
                            <input type="password" id="new_password" class="form-control" placeholder="Mínimo 6 caracteres alfanuméricos" style="height: 38px; font-size: 0.85rem;" minlength="6" required>
                            <span style="font-size: 0.72rem; color: #64748b; margin-top: 4px; display: block;">Clave inicial asignada. Podrá ser modificada posteriormente.</span>
                        </div>
                    </div>
                    <div class="modal-footer" style="padding: 1rem 1.75rem; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 0.75rem;">
                        <button type="button" class="btn btn-secondary" onclick="cambiarTabUsuario('lista')">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="btn-guardar-usuario" style="padding: 0.5rem 1.25rem; font-size: 0.82rem; font-weight: 600;">Registrar Cuenta</button>
                    </div>
                </form>
            </div>

            <!-- Mini Modal / Prompt para Cambio de Contraseña -->
            <div id="panel-cambio-clave" style="display: none; padding: 1.25rem 1.75rem; border-top: 1px solid #bfdbfe; background: #eff6ff;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                    <div>
                        <span style="font-size: 0.82rem; font-weight: 700; color: #1e3a8a;">Actualizar Contraseña: <span id="pwd-user-name" style="color: #2563eb;"></span></span>
                        <div style="font-size: 0.74rem; color: #475569; margin-top: 2px;">Ingrese la nueva clave de acceso para esta cuenta (mínimo 6 caracteres).</div>
                    </div>
                    <button type="button" onclick="cancelarCambioClave()" style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 4px; padding: 4px 10px; font-size: 0.76rem; color: #64748b; cursor: pointer;">Cancelar</button>
                </div>
                <div style="display: flex; gap: 0.65rem; align-items: center; max-width: 520px;">
                    <input type="hidden" id="pwd-user-id">
                    <input type="password" id="input-nueva-clave" class="form-control" placeholder="Nueva contraseña segura" style="height: 38px; flex: 1; font-size: 0.82rem;">
                    <button type="button" class="btn btn-primary" style="height: 38px; padding: 0 1.15rem; font-size: 0.8rem; font-weight: 600;" onclick="ejecutarCambioClave()">Guardar Clave</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</body>
</html>
