<?php

namespace Kabum\libs;

use DateTime;

class Util
{
	public static function validaCampos($campos, $input)
	{
		if (!is_array($input)) {
			return false;
		}

		if (!is_array($campos)) {
			return false;
		}

		foreach ($campos as $campo) {
			if (!isset($input[$campo]) || trim($input[$campo]) == '') {
				return false;
			}
		}

		return true;
	}

	public static function mask($value, $mask)
	{
		$masked = "";
		$k = 0;

		for ($i = 0; $i < strlen($mask); $i++) {
			if ($mask[$i] == "#") {
				if (isset($value[$k])) {
					$masked .= $value[$k++];
				}
			} else {
				if (isset($mask[$i])) {
					$masked .= $mask[$i];
				}
			}
		}

		return $masked;
	}

	public static function maskCpf($value)
	{
		$value = str_replace([".", "-", "/", " "], "", $value);
		if (strlen($value) != 11) {
			return null;
		}

		return self::mask($value, "###.###.###-##");
	}

	public static function maskCnpj($value)
	{
		$value = str_replace([".", "-", "/", ""], "", $value);
		if (strlen($value) != 14) {
			return null;
		}

		return self::mask($value, "##.###.###/####-##");
	}

	public static function maskCep($value)
	{
		$value = preg_replace('/[^0-9]{1,}/', '', $value);
		if (strlen($value) != 8) {
			return null;
		}

		return self::mask($value, "#####-###");
	}

	public static function maskTelefone($value)
	{
		$value = str_replace(["(", ")", "-", "+", " "], "", $value);
		if (strlen($value) < 8 || strlen($value) > 13) {
			return null;
		}

		switch (strlen($value)) {
			case 8:
				$mask = "####-####";
				break;
			case 9:
				$mask = "#####-####";
				break;
			case 10:
				$mask = "(##) ####-####";
				break;
			case 11:
				$mask = "(##) #####-####";
				break;
			case 12:
				$mask = "## (##) ####-####";
				break;
			case 13:
				$mask = "## (##) #####-####";
				break;
		}

		return self::mask($value, $mask);
	}

	public static function formatMoneyBanco($value)
	{
		return str_replace(',', '.', str_replace('.', '', $value));
	}

	public static function maskMoney($value)
	{
		return number_format($value, 2, ',', '.');
	}

	public static function unmaskMoney($value)
	{
		$value = str_replace(".", "", $value);
		$value = str_replace(",", ".", $value);
		return $value;
	}

	public static function formataExibicaoData($data)
	{
		$date = date_create(str_replace('/', '-', $data));

		return date_format($date, "d/m/Y");
	}

	public static function formataExibicaoMesAno($data)
	{
		$date = date_create(str_replace('/', '-', $data));

		return date_format($date, "m/Y");
	}

	public static function normalizaExibicaoStrings($str)
	{
		$str = mb_convert_case($str,  MB_CASE_TITLE);
		return ucwords($str);
	}

	public static function removeHoraDateTime($str)
	{
		$formata_data = new DateTime($str);
		return $formata_data->format('Y-m-d');
	}

	public static function removeDataDateTime($str)
	{
		$formata_data = new DateTime($str);
		return $formata_data->format('H:i');
	}

	public static function returnQtdDiasDifEntreDuasDatas($data)
	{
		$data_atual = date("Y-m-d");

		// remove a hora de login para comparar apenas as datas
		$data_recebida = Util::removeHoraDateTime($data);

		// Inst??ncia um objeto DateTime passando a data 1
		$datetime1 = new DateTime($data_atual);

		// Inst??ncia um objeto DateTime passando a data 2
		$datetime2 = new DateTime($data_recebida);

		// Captura a diferen??a entre a data 1 e a data 2
		$result = $datetime1->diff($datetime2);

		// Retorna a diferen??as em dias
		return $result->days;
	}

	public static function somaDiasEmData($data, $qtd_dias)
	{
		$data = Util::removeHoraDateTime($data);
		$nova_data = date("d/m/Y", strtotime("$data +$qtd_dias day"));

		return $nova_data;
	}

	public static function somaDiasEmDataExato($data, $qtd_dias)
	{
		$nova_data = date("d/m/Y", strtotime("$data +$qtd_dias day"));

		return $nova_data;
	}

	public static function formataLimpaString($str)
	{
		return preg_replace("/[^0-9]/", "", $str);
	}

	public static function removerAcentos($texto)
	{
		return preg_replace(array("/(??|??|??|??|??)/", "/(??|??|??|??|??)/", "/(??|??|??|??)/", "/(??|??|??|??)/", "/(??|??|??|??)/", "/(??|??|??|??)/", "/(??|??|??|??|??)/", "/(??|??|??|??|??)/", "/(??|??|??|??)/", "/(??|??|??|??)/", "/(??)/", "/(??)/"), explode(" ", "a A e E i I o O u U n N"), $texto);
	}

	public static function geraNumeroAleatorios()
	{
		// $result = null;
		// for ($i = 0; $i < $tamanho; $i++) {
		// 	$result .= mt_rand(0, 9);
		// }
		// return $result;

		srand(time());
		$aleatorio = rand();
		$aleatorio = substr($aleatorio, -6);

		return $aleatorio;
	}

	//UTILIZADO NO APP (n??o alterar)
	public static function consultaCep($cep)
	{
		$cep = preg_replace("/[^0-9]/", "", $cep); //Limpa caracteres

		if (strlen($cep) != 8) {
			return false;
		} else {
			$json = file_get_contents("https://viacep.com.br/ws/{$cep}/json/");
			return json_decode($json);
		}
	}

	//Ajusta para Camel Case
	//UTILIZADO NO APP (n??o alterar)
	public static function camelCase($nome)
	{
		//$final = ucwords(strtolower($nome));
		$final = mb_convert_case($nome,  MB_CASE_TITLE);
		$final = str_replace(" Da ", " da ", $final);
		$final = str_replace(" De ", " de ", $final);
		$final = str_replace(" Do ", " do ", $final);
		return trim($final);
	}

	public static function dataBanco($data)
	{
		if (!empty($data)) {
			$string = explode("/", $data);
			$dia = $string[0];
			$mes = $string[1];
			$ano = $string[2];
			$data = $ano . "-" . $mes . "-" . $dia;
		}

		return $data;
	}

	public static function getIpUser()
	{
		$ipaddress = '';

		if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		} else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		} else if (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
			$ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
		} else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		} else if (isset($_SERVER['HTTP_FORWARDED'])) {
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		} else if (isset($_SERVER['REMOTE_ADDR'])) {
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		} else {
			$ipaddress = 'UNKNOWN';
		}

		if ($ipaddress == '::1') { // LOCALHOST
			$ipaddress = '127.0.0.1';
		}

		return $ipaddress;
	}
}
