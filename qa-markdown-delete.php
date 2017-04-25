<?php

class qa_markdown_delete
{
	public function match_request($request)
	{
		return (strpos($request, 'qa-markdown-delete') !== false);
	}

	public function process_request($request)
	{
    require_once QA_INCLUDE_DIR.'app/blobs.php';

    $parts = parse_url($request);
    parse_str($parts['query'], $query);
    $id = $query('id');

    if ($id) {
      qa_delete_blob($id);
    }

		return null;
	}
}
