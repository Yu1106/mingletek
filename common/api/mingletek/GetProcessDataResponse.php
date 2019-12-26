<?php


namespace common\api\mingletek;

use common\PropertyRecord;

/**
 * Class StartProcessResponse
 * @package common\api\mingletek
 * @property string $user
 * @property string $filename
 * @property string $collar
 * @property string $collar_confidence
 * @property string $collar_desc
 * @property string $neckline
 * @property string $neckline_confidence
 * @property string $neckline_desc
 * @property string $neckshoulder
 * @property string $neckshoulder_confidence
 * @property string $neckshoulder_desc
 * @property string $sleeve
 * @property string $sleeve_confidence
 * @property string $sleeve_desc
 * @property string $accessory_1
 * @property string $accessory_1_confidence
 * @property string $accessory_1_desc
 * @property string $pattern
 * @property string $pattern_confidence
 * @property string $pattern_desc
 * @property string $waist
 * @property string $waist_confidence
 * @property string $waist_desc
 * @property string $color_name
 * @property string $color_desc
 * @property string $sub_category
 * @property string $sub_category_confidence
 * @property string $sub_category_desc
 * @property string $category
 * @property string $category_confidence
 * @property string $category_desc
 * @property string $filename_add_1
 * @property string $filename_add_1_confidence
 * @property string $filename_add_2
 * @property string $filename_add_2_confidence
 * @property string $filename_add_3
 * @property string $filename_add_3_confidence
 * @property string $filename_add_4
 * @property string $filename_add_4_confidence
 * @property string $filename_add_5
 * @property string $filename_add_5_confidence
 * @property string $filename_add_6
 * @property string $filename_add_6_confidence
 * @property string $filename_add_7
 * @property string $filename_add_7_confidence
 * @property string $filename_add_8
 * @property string $filename_add_8_confidence
 * @property string $filename_add_9
 * @property string $filename_add_9_confidence
 * @property string $filename_add_10
 * @property string $filename_add_10_confidence
 * @property string $texture_1
 * @property string $texture_1_confidence
 * @property string $texture_1_desc
 * @property string $texture_2
 * @property string $texture_2_confidence
 * @property string $texture_2_desc
 * @property string $texture_3
 * @property string $texture_3_confidence
 * @property string $texture_3_desc
 * @property string $texture_4
 * @property string $texture_4_confidence
 * @property string $texture_4_desc
 * @property string $session_id
 */
class GetProcessDataResponse extends PropertyRecord
{
	/**
	 * @return array
	 */
	public function properties(): array
	{
		return [
			'user',
			'filename',
			'collar',
			'collar_confidence',
			'collar_desc',
			'neckline',
			'neckline_confidence',
			'neckline_desc',
			'neckshoulder',
			'neckshoulder_confidence',
			'$neckshoulder_desc',
			'sleeve',
			'sleeve_confidence',
			'sleeve_desc',
			'accessory_1',
			'accessory_1_confidence',
			'accessory_1_desc',
			'pattern',
			'pattern_confidence',
			'pattern_desc',
			'waist',
			'waist_confidence',
			'waist_desc',
			'color_name',
			'color_desc',
			'sub_category',
			'sub_category_confidence',
			'sub_category_desc',
			'category',
			'category_confidence',
			'category_desc',
			'filename_add_1',
			'filename_add_1_confidence',
			'filename_add_2',
			'filename_add_2_confidence',
			'filename_add_3',
			'filename_add_3_confidence',
			'filename_add_4',
			'filename_add_4_confidence',
			'filename_add_5',
			'filename_add_5_confidence',
			'filename_add_6',
			'filename_add_6_confidence',
			'filename_add_7',
			'filename_add_7_confidence',
			'filename_add_8',
			'filename_add_8_confidence',
			'filename_add_9',
			'filename_add_9_confidence',
			'filename_add_10',
			'filename_add_10_confidence',
			'texture_1',
			'texture_1_confidence',
			'texture_1_desc',
			'texture_2',
			'texture_2_confidence',
			'texture_2_desc',
			'texture_3',
			'texture_3_confidence',
			'texture_3_desc',
			'texture_4',
			'texture_4_confidence',
			'texture_4_desc',
			'session_id',
		];
	}
}