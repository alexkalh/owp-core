<?php

namespace OwpCore\Contract\Comment;

interface CommentItemParamsInterface {
	const DEFAULT_AVATAR_SIZE = 64;
	const DEFAULT_MAX_DEPTH = 5;

	public function set_comment( \WP_Comment $comment ): void;

	public function get_comment(): \WP_Comment;

	public function set_depth( int $depth ): void;

	public function get_depth(): int;

	public function set_args( array $args ): void;

	public function get_args(): array;
}