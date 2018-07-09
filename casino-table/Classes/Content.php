<?php


/**
 * Class Content
 * @return content for table cells by name
 */
class Content {

	protected $casinosDir;
	protected $casinosImg;
	protected $iconsDir;
	protected $CasinosInfo;
	protected $type;

	public function __construct( $casino, $type = '' ) {
		$Params           = new SettingsTable();
		$this->iconsDir   = $Params->getIconsImageDirectory();
		$this->casinosDir = $Params->getCasinosImageDirectory();
		$this->type       = $type;
		global $wpdb;
		$table_name        = $wpdb->prefix . 'casinos';
		$this->CasinosInfo = $wpdb->get_row( "SELECT *  FROM `$table_name` WHERE `name` LIKE '$casino' LIMIT 1" );
	}

	public function name() {
		$img    = new Imeges();
		$imgUrl = $img->CasinoImg( $this->CasinosInfo->name );
		if ( str_replace( $this->casinosDir, '', $imgUrl ) == 'no-image.jpg' ) {
			$status_print = 'Файл не выбран';
		} else {
			$status_print = str_replace( $this->casinosDir, '', $imgUrl );
		}
		if ( $this->type == 'admin' ) {
			$content = '<input type="text" class="js_casinoName" name="name[]" value="' . $this->CasinosInfo->name . '" placeholder="Имя Казино" required >';
			$content .= '<input type="hidden" name="hidden_name[]" value="' . $this->CasinosInfo->name . '">';
			$content .= '<input type="text" name="sub_name[]" value="' . $this->CasinosInfo->sub_name . '" placeholder="доп имя казино">';
			$content .= '<label class="table_casino__uploadImg_lable"><img class="table_casino__uploadImg_image" src=' . $imgUrl . ' alt="' . $this->CasinosInfo->name . '">';
			$content .= '<p class="table_casino__uploadImg_text">' . $status_print . '</p><input class="table_casino__uploadImg_upload" type="file" name="fileImg[]" accept="image/jpeg,image/png"></lable>';
		} else {
			$content = '<p class="table_casino__name">' . $this->CasinosInfo->name . '</p>';
			$content .= '<p class="table_casino__subName">' . $this->CasinosInfo->sub_name . '</p>';
			$content .= '<img class="table_casino__img" src=' . $imgUrl . ' alt="' . $this->CasinosInfo->name . '">';
		}

		return $content;
	}

	public function bonus() {
		$bonus      = explode( ",", $this->CasinosInfo->bonus );
		$bonus_val  = $bonus[0];
		$bonus_desc = $bonus[1];
		if ( $this->type == 'admin' ) {
			$content = '<input type="text" name="bonus_val[]" value="' . $bonus_val . '" placeholder="Бонус казино">';
			$content .= '<input type="text" name="bonus_desc[]" value="' . $bonus_desc . '" placeholder="доп. бонуса">';
		} else {
			$content = '<p class="td_bonus__val">' . $bonus_val . '</p>
                <p class="td_bonus__desc">' . $bonus_desc . '</p>';
		}

		return $content;
	}

	public function wager() {
		if ( $this->type == 'admin' ) {
			$content = '<input type="text" name="wager[]" value="' . $this->CasinosInfo->wager . '" placeholder="Число вейджера" >';
		} else {
			$content = $this->CasinosInfo->wager;
		}

		return $content;
	}

	public function evaluation() {
		if ( $this->type == 'admin' ) {
			$content = '<input type="text" name="evaluation[]" value="' . $this->CasinosInfo->evaluation . '" placeholder="Оценка казино">';
		} else {
			$content = $this->CasinosInfo->evaluation;
		}

		return $content;
	}

	public function bonus_type() {
		if ( $this->type == 'admin' ) {
			$content = '<textarea name="bonus_type[]" placeholder="Типы бонусов">' . $this->CasinosInfo->bonus_type . '</textarea>';
		} else {
			$content = $this->CasinosInfo->bonus_type;
		}

		return $content;
	}

	public function manufacturers() {
		$content       = '';
		$manufacturers = explode( ",", $this->CasinosInfo->manufacturers );

		if ( $this->type == 'admin' ) {
			$content .= '<select size="6" multiple  name="manufacturers[' . $this->CasinosInfo->name . '][]" required>';
			$dir     = $_SERVER['DOCUMENT_ROOT'] . str_replace( home_url(), "", $this->iconsDir );
			$files   = array_diff( scandir( $dir ), array( '..', '.' ) );
			foreach ( $files as $file ) {
				$fileName = explode( ".", $file )[0];
				$select   = null;
				if ( in_array( $fileName, $manufacturers ) ) {
					$select = 'selected';
				}
				$content .= '<option  ' . $select . ' value="' . $fileName . '">' . $fileName . '</option>';
			}
			$content .= '</select>';
		} else {
			for ( $i = 0; $i < count( $manufacturers ); $i ++ ) {
				$icons   = new Imeges();
				$content .= '<img src="' . $icons->IconsUrl( $manufacturers[ $i ] ) . '" alt="' . $manufacturers[ $i ] . '" title="' . $manufacturers[ $i ] . '">';
			}
		}

		return $content;
	}

	public function currencies() {
		if ( $this->type == 'admin' ) {
			$currenciesArr = array( 'uah' => 'Гривна', 'rub' => 'Рубли', 'dol' => 'Доллар', 'euro' => 'Евро' );
			$content       = '<select size="4" multiple name="currencies[' . $this->CasinosInfo->name . '][]" required>';
			$arr_curren    = explode( ",", $this->CasinosInfo->currencies );
			foreach ( $currenciesArr as $curren => $namecurren ) {
				$select = null;
				if ( in_array( $curren, $arr_curren ) ) {
					$select = 'selected';
				}
				$content .= '<option  ' . $select . ' value="' . $curren . '">' . $namecurren . '</option>';
			}
			$content .= '</select>';

		} else {
			$content = $this->CasinosInfo->currencies;
		}

		return $content;
	}

	public function buttons() {
		if ( $this->type == 'admin' ) {
			$content = '';
			$content .= '<div class="custoom_button">
                        <p>Кнопка 1</p>
                        <input class="custoom_button__name" type="text" name="casinoButtonName[]" value="' . $this->CasinosInfo->casinoButtonName . '" placeholder="Имя кнопки 1" required>
                        <input class="custoom_button__url" type="url" name="casinoURL[]" value="' . $this->CasinosInfo->casinoURL . '" placeholder="адресс http:// " required>
                        </div>';
			$content .= '<div class="custoom_button">
                        <p>Кнопка 2</p>
                        <input class="custoom_button__name" type="text" name="verviewButtonName[]" value="' . $this->CasinosInfo->verviewButtonName . '" placeholder="Имя кнопки 2"  >
                        <input class="custoom_button__url" type="url" name="verviewURL[]" value="' . $this->CasinosInfo->verviewURL . '"  placeholder="адресс http:// ">
                        </div>';
			$content .= '<div class="custoom_button">
                        <p>Кнопка 3</p>
                        <input class="custoom_button__name" type="text" name="reviewsButtonName[]" value="' . $this->CasinosInfo->reviewsButtonName . '" placeholder="Имя кнопки 3"  >
                        <input class="custoom_button__url" type="url" name="reviewsURL[]" value="' . $this->CasinosInfo->reviewsURL . '" placeholder="адресс http:// " >
                        </div>';
		} else {
			$content = '<a class="btn_casino" target="_blank" href="' . $this->CasinosInfo->casinoURL . '">В Казино</a>';
			if ( ! empty( trim( $this->CasinosInfo->verviewURL ) ) ) {
				$content .= '<a class="btn_overview" href="' . $this->CasinosInfo->verviewURL . '">Обзор Казино</a>';
			}
			if ( ! empty( trim( $this->CasinosInfo->reviewsURL ) ) ) {
				$content .= '<a class="btn_reviews" href="' . $this->CasinosInfo->reviewsURL . '">Оставить отзыв</a>';
			}
		}

		return $content;
	}

	public function actions() {
		if ( $this->type == 'admin' ) {
			$content = '<button class="button_del_row" type="button"></button>';
			$content .= '<button class="btn_addNewCasino" type="button"></button>';
		} else {
			$content = null;
		}

		return $content;
	}
}