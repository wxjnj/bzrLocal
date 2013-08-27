<?php
class FfmpegManager{
	
	public static function infoToString($filename){
		extension_loaded('ffmpeg');
		
		$ffmpegInstance = new ffmpeg_movie($filename);
		echo "getDuration: " . $ffmpegInstance->getDuration()."<br>" .
				"getFrameCount: " . $ffmpegInstance->getFrameCount()."<br>" .
				"getFrameRate: " . $ffmpegInstance->getFrameRate()."<br>" .
				"getFilename: " . $ffmpegInstance->getFilename()."<br>" .
				"getComment: " . $ffmpegInstance->getComment()."<br>" .
				"getTitle: " . $ffmpegInstance->getTitle()."<br>" .
				"getAuthor: " . $ffmpegInstance->getAuthor()."<br>" .
				"getCopyright: " . $ffmpegInstance->getCopyright()."<br>" .
				"getArtist: " . $ffmpegInstance->getArtist()."<br>" .
				"getGenre: " . $ffmpegInstance->getGenre()."<br>" .
				"getTrackNumber: " . $ffmpegInstance->getTrackNumber()."<br>" .
				"getYear: " . $ffmpegInstance->getYear()."<br>" .
				"getFrameHeight: " . $ffmpegInstance->getFrameHeight()."<br>" .
				"getFrameWidth: " . $ffmpegInstance->getFrameWidth()."<br>" .
				"getPixelFormat: " . $ffmpegInstance->getPixelFormat()."<br>" .
				"getBitRate: " . $ffmpegInstance->getBitRate()."<br>" .
				"getVideoBitRate: " . $ffmpegInstance->getVideoBitRate()."<br>" .
				"getAudioBitRate: " . $ffmpegInstance->getAudioBitRate()."<br>" .
				"getAudioSampleRate: " . $ffmpegInstance->getAudioSampleRate()."<br>" .
				"getVideoCodec: " . $ffmpegInstance->getVideoCodec()."<br>" .
				"getAudioCodec: " . $ffmpegInstance->getAudioCodec()."<br>" .
				"getAudioChannels: " . $ffmpegInstance->getAudioChannels()."<br>" .
				"hasAudio: " . $ffmpegInstance->hasAudio();
	}
	
	public static function PrtSc($input_file,$output_file,$start_time=1,$offset=1.001,$size='100*75'){
		exec('ffmpeg -i '.$input_file.' -f image2 -ss '.$start_time.' -t '.$offset.' -s '.$size.' '.$output_file);
	}
	public static function PrtSc2($input_file,$output_file,$start_time=1,$offset=1.001,$size='100*75'){
		return 'ffmpeg -i '.$input_file.' -f image2 -ss '.$start_time.' -t '.$offset.' -s '.$size.' '.$output_file;
	}
	
}