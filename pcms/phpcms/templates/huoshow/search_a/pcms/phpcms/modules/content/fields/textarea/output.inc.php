	function textarea($field, $value) {
		if($field=='description')
			$value = htmlspecialchars($value);
		return $value;
	}
	