<?php

class qa_markdown_upload
{
	public function match_request($request)
	{
		return ($request == 'qa-markdown-upload');
	}

	public function process_request($request)
	{
		$message = '';
		$url = '';

		if (is_array($_FILES) && count($_FILES)) {
			require_once QA_INCLUDE_DIR.'app/upload.php';

			$upload = qa_upload_file_one(
				qa_get_max_upload_size(), // do not restrict upload size
				true, // force upload to image only
				500, // max width (px)
				500 // max height (px)
			);

			$message = @$upload['error'];
			$url = @$upload['bloburl'];
      $id = @$upload['blobid'];
		}

    header('Content-type: application/json');
    echo json_encode([
      'error'=>$message,
      'url'=>$url,
      'id'=>$id,
    ]);

		return null;
	}
}
