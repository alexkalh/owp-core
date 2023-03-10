<?php

namespace OwpCore\Comment;

use OwpCore\Contract\Comment\CommentItemParamsInterface;

class CommentItemParams implements CommentItemParamsInterface {
	private \WP_Comment $comment;
	private int $depth;
	private array $args;

	public function set_comment( \WP_Comment $comment ): void {
		$this->comment = $comment;
	}

	public function get_comment(): \WP_Comment {
		return $this->comment;
	}

	public function set_depth( int $depth ): void {
		$this->depth = $depth;
	}

	public function get_depth(): int {
		return $this->depth;
	}

	public function set_args( array $args ): void {
		$this->args = $args;
	}

	public function get_args(): array {
		return $this->args;
	}
}

