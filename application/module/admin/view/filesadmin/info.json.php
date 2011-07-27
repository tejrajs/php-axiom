<?=json_encode(array(
    i18n('admin.files.file.name') => $file->filename,
    i18n('admin.files.file.size') => i18n('units.kB', ceil($file->getSize() / 1024)),
    i18n('admin.files.file.path') => src("upload/$file->filename"),
    i18n('admin.files.file.type') => $file->mime_type,
    i18n('admin.files.file.date') => $file->upload,
    i18n('admin.files.file.user') => $file->getUser()->login,
))?>