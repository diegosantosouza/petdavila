<?php

return [
    'exception_message' => 'Exception message: :message',
    'exception_trace' => 'Exception trace: :trace',
    'exception_message_title' => 'Exception message',
    'exception_trace_title' => 'Exception trace',

    'backup_failed_subject' => 'Falha no backup da aplicação :application_name',
    'backup_failed_body' => 'Importante: Ocorreu um erro ao fazer o backup da aplicação :application_name',

    'backup_successful_subject' => 'Backup realizado com sucesso: :application_name',
    'backup_successful_subject_title' => 'Backup Realizado com sucesso!',
    'backup_successful_body' => 'Boas notícias, um novo backup da aplicação :application_name foi criado no disco :disk_name.',

    'cleanup_failed_subject' => 'Falha na limpeza dos backup da aplicação :application_name.',
    'cleanup_failed_body' => 'Um erro ocorreu ao fazer a limpeza dos backup da aplicação :application_name',

    'cleanup_successful_subject' => 'Limpeza dos backup da aplicação :application_name concluída!',
    'cleanup_successful_subject_title' => 'Limpeza dos backup concluída!',
    'cleanup_successful_body' => 'A limpeza dos backup da aplicação :application_name no disco :disk_name foi concluída.',

    'healthy_backup_found_subject' => 'Os backup da aplicação :application_name no disco :disk_name estão em dia',
    'healthy_backup_found_subject_title' => 'Os backup da aplicação :application_name estão em dia',
    'healthy_backup_found_body' => 'Os backup da aplicação :application_name estão em dia. Bom trabalho!',

    'unhealthy_backup_found_subject' => 'Importante: Os backup da aplicação :application_name não estão em dia',
    'unhealthy_backup_found_subject_title' => 'Importante: Os backup da aplicação :application_name não estão em dia. :problem',
    'unhealthy_backup_found_body' => 'Os backup da aplicação :application_name no disco :disk_name não estão em dia.',
    'unhealthy_backup_found_not_reachable' => 'O destino dos backup não pode ser alcançado. :error',
    'unhealthy_backup_found_empty' => 'Não existem backup para essa aplicação.',
    'unhealthy_backup_found_old' => 'O último backup realizado em :date é considerado muito antigo.',
    'unhealthy_backup_found_unknown' => 'Desculpe, a exata razão não pode ser encontrada.',
    'unhealthy_backup_found_full' => 'Os backup estão usando muito espaço de armazenamento. A utilização atual é de :disk_usage, o que é maior que o limite permitido de :disk_limit.',
];
